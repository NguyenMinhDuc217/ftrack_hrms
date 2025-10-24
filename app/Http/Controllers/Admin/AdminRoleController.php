<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminRoleController extends Controller
{
    public function index()
    {
        $user = auth()->guard()->user();
        $user_role = $user->roles()->first();

        $roles = Role::where('id', '>=', $user_role['id'])->get();
        return view('admin.role.index', ['roles' => $roles]);
    }

    public function create()
    {
        $data = [];
        $data['action'] = 'create';

        // Use translation keys
        $data['page_title'] = __('role.page_title_create');
        $data['heading_title'] = __('role.heading_title_create');

        $data['form_url'] = route('admin.role.store');

        $data['breadcrumbs'] = [
            // Note: The original code used 'role.heading_title_create' here, which now works
            ['label' => __('role.heading_title_create'), 'url' => route("admin.role.index")],
            ['label' => __('role.create')], // Use a more general 'create' key for the last breadcrumb
        ];

        return view('admin.role.form', $data);
    }

    public function store(RoleRequest $request)
    {
        $data = $request->safe();
        $role = new Role();
        $role->guard_name = 'web';
        $role->name = $data['name'];

        $role->save();

        return redirect(route('admin.role.index'))->with('success', __('role.created_success'));
        // NOTE: A new key 'created_success' should be added to the translation files for a success message after creation.
    }

    public function edit(string $role_id)
    {
        $data = [];
        $role = Role::find(intval($role_id));

        if (empty($role)) {
            // Use translation key, appending the ID for context
            $message = __('role.not_found_id') . ' ' . $role_id;
            return abort('404', $message);
        }

        $user = auth()->guard()->user();
        $user_role = $user->roles()->first();
        $has_permision = auth()->guard()->user()->hasPermissionTo('admin.role.permissions.update');
        $can_edit_current_role = $user_role['id'] <= $role_id;

        if (empty($can_edit_current_role)) {
            return abort('403');
        }

        $data['can_edit_permission'] = $has_permision && $can_edit_current_role;

        $data['all_permissions'] = Permission::all()->pluck('name'); 
        
        $data['assigned_permissions'] = $role->permissions->pluck('name')->toArray();



        $data['role'] = $role;
        $data['action'] = 'edit';

        // Use translation keys
        $data['page_title'] = __('role.page_title_edit');
        $data['heading_title'] = __('role.heading_title_edit');
        $data['form_url'] = route('admin.role.update', $role_id);

        return view('admin.role.form', $data);
    }

    public function update(string $role_id, RoleRequest $request)
    {
        $role = Role::findById($role_id);

        if (empty($role)) {
            // Use translation key, appending the ID for context
            $message = __('role.not_found_id') . ' ' . $role_id;
            return abort('404', $message);
        }

        $data = $request->safe();
        $role->name = $data['name'];
        $role->save();

        return redirect(route('admin.role.index'))->with('success', __('role.updated_success'));
        // NOTE: A new key 'updated_success' should be added to the translation files for a success message after update.
    }

        /**
     * Update the permissions for a specific role.
     */
    public function updatePermissions(Request $request, Role $role)
    {
        $validated = $request->validate([
            'permissions' => 'nullable|array',
            'permissions.*' => 'string', // You might add |exists:permissions,name for strict validation
        ]);

        $role->syncPermissions($validated['permissions'] ?? []);

        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        return response()->json([
            'message' => __('role.permissions_updated_success'),
            'permissions' => $role->permissions->pluck('name'),
        ], 200);
    }

    public function delete(string $role_id, Request $request)
    {
        $role = Role::find(intval($role_id));

        if (empty($role)) {
            // Use translation keys for AJAX response
            $ajax_message = __('role.not_found_ajax');

            // Use translation key for standard response
            $standard_message = __('role.not_found_id') . ' ' . $role_id;

            return $request->ajax()
                ? response()->json(['message' => $ajax_message], 404)
                : abort('404', $standard_message);
        }

        $role->delete();

        // Use translation key for success message
        $success_message = __('role.deleted_success');

        return $request->ajax()
            ? response()->json(['message' => $success_message], 200)
            : redirect(route('admin.role.index'))->with('success', $success_message);
    }
}
