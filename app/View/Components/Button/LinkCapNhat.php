<?php

namespace App\View\Components\Button;

use Illuminate\View\Component;

class LinkCapNhat extends Component
{
    protected $icon;
    protected $colorClass;
    protected $extClass;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon='edit',$colorClass='warning', $extClass = "")
    {
        $this->icon = $icon;
        $this->colorClass = $colorClass;
        $this->extClass = $extClass;
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
            'colorClass'=>$this->colorClass." ".$this->extClass,
        ]);
    }
}
