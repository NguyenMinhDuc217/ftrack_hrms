<?php

namespace App\View\Components\Admin;

use App\Models\Menu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $menus = Menu::whereNull('parent_id')->with('children')->orderBy('id')->get();
        return view('components.admin.sidebar',['menus' => $menus]);
    }
}
