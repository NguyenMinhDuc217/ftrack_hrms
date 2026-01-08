<?php

namespace App\View\Components\Client;

use App\Models\Profession;
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
            case 'profession_slug':
                $filters = Profession::select('slug', 'profession_name as name')->active()->get();
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
                $type = 'profession_slug';
                $val = $this->val;
                $filters = Profession::select('slug', 'profession_name as name')->active()->get();
                break;
        }

        return view('components.client.filter', ['filters' => $filters, 'type' => $type, 'val' => $val]);
    }
}
