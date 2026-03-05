<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    // Display the registration form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle the registration attempt
    public function register(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string','regex:/^0\d{9}$/', 'unique:users,phone_number'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)], // Use Rule::unique
            'password' => ['required', 'string', 'min:8', 'confirmed'], // 'confirmed' checks for password_confirmation field
        ]);

        $user = User::create([
            'username' => $request->username,
            'phone_number' => $request->phone_number,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::loginUsingId($user->user_id); // Log the user in immediately after registration

        $backUrl = $request->session()->get('_previous', ['url' => route('client.dashboard')]);
        $cvs = UserDocument::where('user_id', $user->user_id)
            ->where('document_type', 'cv_file')
            ->where('deleted_at', null)
            ->count();

        if ($cvs === 0) {
            session(['show_create_cv_modal' => true]);
        }

        // return redirect(route('client.dashboard')); // Redirect to client dashboard
        return redirect()->intended($backUrl['url']);
    }
}
