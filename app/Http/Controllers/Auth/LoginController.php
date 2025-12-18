<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Socialite;
use Str;

class LoginController extends Controller
{
    // Display the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle the login attempt
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate(true);

            $user = Auth::user();

            if ($user->hasPermissionTo('admin.dashboard')) {
                return redirect()->intended(route('admin.dashboard'));
            }

            $backUrl = $request->session()->get('_previous', ['url' => route('client.dashboard')]);

            $cvs = UserDocument::where('user_id', $user->user_id)
                ->where('document_type', 'cv_file')
                ->where('deleted_at', null)
                ->count();

            if ($cvs === 0) {
                session(['show_create_cv_modal' => true]);
            }

            // Redirect to the client dashboard after successful login
            // return redirect()->intended(route('client.dashboard'));

            return redirect()->intended($backUrl['url']);
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    // Log the user out
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Redirect to the homepage after logout
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Google callback, tạo / đăng nhập user
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()
                ->route('login')
                ->with('error', 'Đăng nhập Google thất bại, vui lòng thử lại.');
        }

        $user = User::where('email', $googleUser->getEmail())->first();

        if (! $user) {

            $split_name = $this->splitNameVN($googleUser->getName());
            $user = User::create([
                'username' => $googleUser->getEmail(),
                'first_name' => $split_name['first_name'],
                'last_name' => $split_name['last_name'],
                'email' => $googleUser->getEmail(),
                'avatar' => $googleUser->getAvatar(),
                'password' => bcrypt(Str::random(32)),
                'role' => 'user',
                'google_id' => $googleUser->getId(),
                'login_type' => 'google',
            ]);
        }

        Auth::login($user, true);

        return redirect('/');
    }

    private function splitNameVN(string $fullName): array
    {
        $fullName = trim(preg_replace('/\s+/', ' ', $fullName));

        $parts = explode(' ', $fullName);

        if (count($parts) === 1) {
            return [
                'first_name' => $parts[0],
                'last_name' => '',
            ];
        }

        $firstName = array_pop($parts);
        $lastName = implode(' ', $parts);

        return [
            'first_name' => $firstName,
            'last_name' => $lastName,
        ];
    }
}
