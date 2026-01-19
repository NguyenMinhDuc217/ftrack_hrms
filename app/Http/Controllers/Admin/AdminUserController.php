<?php

namespace App\Http\Controllers\Admin;

use App\Enums\EmploymentType;
use App\Enums\Gender;
use App\Enums\UserStatus;
use App\Filters\UserFilter;
use App\Http\Requests\UserPostRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        if (Auth::user()->role_id != 1) {
            $query->where('role_id', '!=', 1);
        }
        $users = $query->filter(new UserFilter($request))->paginate(10);
        $users->appends($request->all());

        $statuses = collect(UserStatus::cases())->mapWithKeys(function ($status) {
            return [
                $status->value => $status->getLabelData(),
            ];
        })->toArray();
        $query_managers = User::select('user_id', 'username')->where('status', UserStatus::ACTIVE->value);
        if (Auth::user()->role_id != 1) {
            $query_managers->where('role_id', '!=', 1);
        }
        $managers = $query_managers->get();
        $employment_types = collect(EmploymentType::cases())->mapWithKeys(function ($type) {
            return [
                $type->value => $type->getLabelData(),
            ];
        })->toArray();

        return view('admin.user.index', [
            'users' => $users,
            'statuses' => $statuses,
            'managers' => $managers,
            'employment_types' => $employment_types,
        ]);
    }

    public function create()
    {
        $query_users = User::select('user_id', 'username')->where('status', UserStatus::ACTIVE->value);
        if (Auth::user()->role_id != 1) {
            $query_users->where('role_id', '!=', 1);
        }
        $users = $query_users->get();
        $employment_types = collect(EmploymentType::cases())->mapWithKeys(function ($type) {
            return [$type->value => $type->getLabelData()['label']];
        })->toArray();
        $statuses = collect(UserStatus::cases())->mapWithKeys(function ($status) {
            return [$status->value => $status->getLabelData()['label']];
        })->toArray();
        $genders = Gender::cases();

        return view(
            'admin.user.add',
            [
                'users' => $users,
                'employment_types' => $employment_types,
                'statuses' => $statuses,
                'genders' => $genders,
            ]
        );
    }

    public function show($user_id)
    {
        $user = User::where('user_id', $user_id)->first();
        $users = User::select('user_id', 'username')->where('status', UserStatus::ACTIVE->value)->where('user_id', '!=', $user_id)->get();

        $employment_types = collect(EmploymentType::cases())->mapWithKeys(function ($type) {
            return [$type->value => $type->getLabelData()['label']];
        })->toArray();

        $statuses = collect(UserStatus::cases())->mapWithKeys(function ($status) {
            return [$status->value => $status->getLabelData()['label']];
        })->toArray();

        $genders = Gender::cases();

        $breadcrumbs = [
            ['label' => 'Users', 'url' => route('admin.users')],
            ['label' => 'Edit User: '."{$user->user_id} - {$user->username}", 'url' => route('admin.users.show', $user_id)],
        ];

        return view(
            'admin.user.edit',
            [
                'user' => $user,
                'users' => $users,
                'employment_types' => $employment_types,
                'statuses' => $statuses,
                'genders' => $genders,
                'breadcrumbs' => $breadcrumbs,
            ]
        );
    }

    public function update(UserPostRequest $request, ?User $user = null): RedirectResponse
    {
        $data = $request->validated();

        if ($user) {
            $user->update($data);

            return redirect()->route('admin.users')->with('success', 'User updated successfully.');
        } else {
            $user = User::create($data);

            return redirect()->route('admin.users')->with('success', 'User added successfully.');
        }
    }

    public function delete($user_id): RedirectResponse
    {
        $user = User::find($user_id);
        if (! $user) {
            return redirect()->route('admin.users')->with('error', 'User not found.');
        }
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function changeDepartment($department_id)
    {
        $users = User::where('department_id', $department_id)
            ->where('status', UserStatus::ACTIVE->value)
            ->select('user_id', 'username')
            ->get();

        return response()->json($users);
    }
}
