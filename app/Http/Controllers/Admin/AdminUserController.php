<?php

namespace App\Http\Controllers\Admin;

use App\Enums\EmploymentType;
use App\Enums\Gender;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with('department')->paginate(10);
        return view('admin.user.index', ['users' => $users]);
    }

    public function show($user_id)
    {
        $user = User::with('department')->where('user_id', $user_id)->first();
        $departments = Department::where('status', 'active')->get();
        $employment_types = array_column(EmploymentType::cases(), 'value');
        $statuses = array_column(UserStatus::cases(), 'value');
        $genders = Gender::cases();
        return view(
            'admin.user.edit',
            [
                'user' => $user,
                'departments' => $departments,
                'employment_types' => $employment_types,
                'statuses' => $statuses,
                'genders' => $genders
            ]
        );
    }
}
