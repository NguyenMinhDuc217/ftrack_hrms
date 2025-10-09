<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminRoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('admin.role.index',['roles' => $roles]);
    }
}
