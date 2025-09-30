<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        return view('client.index');
    }
    // Authenticated client dashboard
    public function dashboard()
    {
        return view('client.dashboard', ['user' => Auth::user()]);
    }

    // Authenticated client profile page
    public function profile()
    {
        return view('client.profile', ['user' => Auth::user()]);
    }
}
