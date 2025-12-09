<?php

namespace App\Console\Commands;

use App\Enums\UserRoles;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Middleware\CheckRoutePermission;

class SyncRoutePermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:sync-routes
                            {--prefix=admin. : Only sync routes with this name prefix (e.g., "admin."). Set to empty string to sync all routes using the middleware.}
                            {--middleware=check.permission : Only sync routes using this middleware alias. Set to empty string to sync all routes with the given prefix.}
                            {--assign-to-admin : Assign newly created permissions to the "admin" role (if it exists).}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize named routes with Spatie permissions, creating missing ones and optionally assigning them to an admin role.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Clear Spatie's permission cache before we start creating new ones
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        $routes = Route::getRoutes();
        $syncedPermissionsCount = 0;
        $adminRole = null;

        $prefix = $this->option('prefix');
        $middleware = $this->option('middleware');
        $assignToAdmin = $this->option('assign-to-admin');

        $this->info('Starting permission synchronization based on named routes...');
        $this->newLine();

        if ($assignToAdmin) {
            $adminRole = Role::where('name', UserRoles::ADMIN->value)->first();
            if (!$adminRole) {
                $this->warn('Warning: The "admin" role does not exist. Skipping assignment to admin.');
                $assignToAdmin = false; // Disable assignment if role not found
            } else {
                $this->comment("New permissions will be assigned to the '{$adminRole->name}' role.");
            }
        }
        $this->newLine();

        foreach ($routes as $route) {
            $routeName = $route->getName();

            // Skip routes without a name
            if (empty($routeName)) {
                continue;
            }

            $shouldProcess = false;

            // Filter by prefix if provided
            if (!empty($prefix) && str_starts_with($routeName, $prefix)) {
                $shouldProcess = true;
            }

            // Filter by middleware if provided
            if (!empty($middleware)) {
                $routeMiddleware = $route->middleware(); // Get middleware aliases or class names
                if (in_array($middleware, $routeMiddleware) || in_array(CheckRoutePermission::class, $routeMiddleware)) {
                    $shouldProcess = true;
                } else {
                    // If middleware is specified, and route doesn't have it, don't process.
                    // This overrides prefix filtering if middleware is the primary filter.
                    if (!empty($middleware) && empty($prefix)) { // If only filtering by middleware
                        $shouldProcess = false;
                    }
                    if (!empty($middleware) && !empty($prefix) && !str_starts_with($routeName, $prefix)) {
                        $shouldProcess = false; // Only process if both prefix and middleware match
                    }
                }
            }
            
            // If neither prefix nor middleware is specified, or filters didn't match, skip.
            if (!$shouldProcess && (!empty($prefix) || !empty($middleware))) {
                continue;
            }
            // If both are empty, we'd process all named routes, which is usually not desired.
            // Let's make sure at least one filter is active if they are explicitly set to empty.
            if (empty($prefix) && empty($middleware)) {
                $this->comment("Processing all named routes (no --prefix or --middleware specified). Consider narrowing down with options.");
                $shouldProcess = true; // Process all named routes if no filters
            }


            if ($shouldProcess) {
                if (!Permission::where('name', $routeName)->exists()) {
                    Permission::create(['name' => $routeName]);
                    $this->info("  ✨ Created permission: <fg=yellow>{$routeName}</>");
                    $syncedPermissionsCount++;

                    if ($assignToAdmin && $adminRole) {
                        $adminRole->givePermissionTo($routeName);
                        $this->comment("    - Assigned to role: <fg=cyan>{$adminRole->name}</>");
                    }
                } else {
                    $this->line("  <fg=gray>Permission already exists: {$routeName}</>");
                }
            }
        }

        $this->newLine();
        if ($syncedPermissionsCount > 0) {
            $this->info("Successfully synchronized {$syncedPermissionsCount} missing permissions.");
        } else {
            $this->info("No new permissions to synchronize. All routes are up-to-date.");
        }

        // Clear Spatie's permission cache again after changes
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        $this->info('Permission cache cleared.');
    }
}