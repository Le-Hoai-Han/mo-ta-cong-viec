<?php

namespace App\View\Components\BieuDo;

use Illuminate\View\Component;

class BaseChart extends Component
{
    public $id="myChart";
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id="")
    {
        if($id!=""){
            $this->id = $id;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.bieu-do.base-chart');
    }
}
