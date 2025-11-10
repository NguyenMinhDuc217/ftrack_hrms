<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerPolicies();
        // Define a gate for admin access

        Gate::before(function (User $user, $ability) {
            return ($user->hasRole('super_admin')) ? true : null;
        });
    }
}
