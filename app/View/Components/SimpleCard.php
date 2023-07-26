<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SimpleCard extends Component
{
    public $extClass = "";
    public $extStyle = "";
    public $headerClass = "";
    public $labelCol = 8;
    public $buttonCol = 4;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($extClass = "", $extStyle = "",$headerClass="" ,$labelCol = '8', $buttonCol = '4')
    {
        $this->extClass = $extClass;
        $this->extStyle = $extStyle;
        $this->headerClass = $headerClass;
        $this->labelCol = $labelCol;
        $this->buttonCol = $buttonCol;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.simple-card');
    }
}
