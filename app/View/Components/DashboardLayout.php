<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DashboardLayout extends Component
{
    public $list = [
        '/'=>'Trang chủ'
    ];

    public $current;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($current = "Bảng điều khiển", $list = [])
    {
        //
        $this->list = array_merge($this->list,$list);
        $this->current = $current;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard-layout');
    }
}
