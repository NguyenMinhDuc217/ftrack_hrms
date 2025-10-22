<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;    // Import the App facade
use Illuminate\Support\Facades\Session; // Import the Session facade
use Illuminate\Http\RedirectResponse; // Import RedirectResponse

class LanguageController extends Controller
{
    /**
     * Switch the application locale.
     *
     * @param string $locale The locale to switch to (e.g., 'en', 'vi').
     * @param Request $request The current HTTP request.
     * @return RedirectResponse
     */
    public function switch(string $locale, Request $request): RedirectResponse
    {
        // Validate the locale to prevent invalid values.
        // You can enhance this check with a list of allowed locales from your config.
        if (!in_array($locale, ['en', 'vi'])) {
            $locale = config('app.fallback_locale', 'en'); // Fallback to a safe default
        }

        // Store the selected locale in the user's session
        Session::put('locale', $locale);

        // Set the application's locale for the current request
        App::setLocale($locale);

        // Redirect the user back to the page they came from
        return back();
    }
}