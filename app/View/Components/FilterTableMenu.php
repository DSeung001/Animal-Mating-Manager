<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class FilterTableMenu extends Component
{
    private $action;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action)
    {
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $action = $this->action;
        return view('components.filter-table-menu', compact('action'));
    }
}
