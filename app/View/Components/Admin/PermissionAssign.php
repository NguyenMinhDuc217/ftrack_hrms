<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Spatie\Permission\Models\Role;

class PermissionAssign extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Role $role,
        public Collection $allPermissions,
        public array $assignedPermissions,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.permission-assign');
    }
}
