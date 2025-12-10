<?php

namespace App\View\Components\Client;

use App\Models\Department;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Filter extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $type,
        public $val,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        switch ($this->type) {
            case 'department_id':
                $filters = Department::select('department_id as id', 'department_name as name')->where('status', 'active')->where('deleted_at', null)->get();
                $type = $this->type;
                $val = $this->val;
                break;
            case 'salary':
                $filters = [
                    'min' => 0,
                    'max' => 10000000];
                $type = $this->type;
                break;
            default:
                $type = 'department_id';
                $val = $this->val;
                $filters = Department::select('department_id as id', 'department_name as name')->where('status', 'active')->where('deleted_at', null)->get();
                break;
        }

        return view('components.client.filter', ['filters' => $filters, 'type' => $type, 'val' => $val]);
    }
}
