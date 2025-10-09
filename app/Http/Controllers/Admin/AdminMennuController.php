<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class AdminMennuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menu.index', ['menus' => $menus]);
    }
}
