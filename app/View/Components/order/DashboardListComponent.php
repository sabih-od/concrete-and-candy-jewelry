<?php

namespace App\View\Components\order;

use Illuminate\View\Component;

class DashboardListComponent extends Component
{
    public $orders;
    public $pageType;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($orders , $pageType)
    {
        $this->orders = $orders;
        $this->pageType = $pageType;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.order.dashboard-list-component');
    }
}
