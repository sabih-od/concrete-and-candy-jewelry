<?php

namespace App\View\Components\order;

use Illuminate\View\Component;

class ListComponent extends Component
{
    public $tab;
    public $pageType;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public
    function __construct($tab, $pageType)
    {
        $this->tab = $tab;
        $this->pageType = $pageType;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public
    function render()
    {
        return view('components.order.ListComponent');
    }
}
