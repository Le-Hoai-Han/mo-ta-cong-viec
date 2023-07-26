<?php

namespace App\View\Components\Button;

use Illuminate\View\Component;

class LinkXem extends Component
{
    protected $icon;
    protected $colorClass;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon='list',$colorClass='info')
    {
        $this->icon = $icon;
        $this->colorClass = $colorClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button.base-link',[
            'icon'=>$this->icon,
            'colorClass'=>$this->colorClass
        ]);
    }
}
