<?php

namespace App\Http\Controllers\Admin;

use App\Enums\EmploymentType;
use App\Enums\Gender;
use App\Enums\UserStatus;
use Illuminate\Routing\Controller;
use App\Http\Requests\UserPostRequest;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with('department')->paginate(10);
        return view('admin.user.index', ['users' => $users]);
    }

    public function create()
    {
        $users = User::select('user_id', 'username')->where('status', UserStatus::ACTIVE->value)->get();
        $departments = Department::where('status', 'active')->get();
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
                'departments' => $departments,
                'employment_types' => $employment_types,
                'statuses' => $statuses,
                'genders' => $genders,
            ]
        );
    }
    public function store(UserPostRequest $request)
    {
        $data = $request->validated();
        dd($data);
    }

    public function show($user_id)
    {
        $user = User::with('department')->where('user_id', $user_id)->first();
        $users = User::select('user_id', 'username')->where('status', UserStatus::ACTIVE->value)->where('department_id', $user->department_id)
        ->where('user_id', '!=', $user_id)->get();

        $departments = Department::where('status', 'active')->get();

        $employment_types = collect(EmploymentType::cases())->mapWithKeys(function ($type) {
            return [$type->value => $type->getLabelData()['label']];
        })->toArray();

        $statuses = collect(UserStatus::cases())->mapWithKeys(function ($status) {
            return [$status->value => $status->getLabelData()['label']];
        })->toArray();

        $genders = Gender::cases();

        return view(
            'admin.user.edit',
            [
                'user' => $user,
                'users' => $users,
                'departments' => $departments,
                'employment_types' => $employment_types,
                'statuses' => $statuses,
                'genders' => $genders
            ]
        );
    }

    public function update(UserPostRequest $request, $user_id): RedirectResponse
    {
        $user = User::where('user_id', $user_id)->first();

        if (!$user) {
            return redirect()->route('admin.users.update', ['user_id' => $user_id])->with('error', 'User not found.');
        }

        $data = $request->validated();
            
        // Cập nhật các trường của user
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->phone_number = $data['phone_number'] ?? null;
        $user->first_name = $data['first_name'] ?? null;
        $user->last_name = $data['last_name'] ?? null;
        $user->gender = $data['gender'] ?? null;
        $user->date_of_birth = $data['date_of_birth'] ?? null;
        $user->hire_date = $data['hire_date'] ?? null;
        $user->department_id = $data['department_id'] ?? null;
        $user->manager_id = $data['manager_id'] ?? null;
        $user->document_id = $data['document_id'] ?? null;
        $user->employment_type = $data['employment_type'] ?? null;
        $user->applicant = $data['applicant'] ?? 0;
        $user->status = $data['status'] ?? 'Unverified';
        $user->save();
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
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
