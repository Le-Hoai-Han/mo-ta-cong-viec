<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardSmall extends Component
{
    protected $colorClass;
    protected $desc;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($colorClass = 'primary',$desc='')
    {
        $this->colorClass = $colorClass;
        $this->desc = $desc;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card-small',[
            'colorClass'=>$this->colorClass,
            'desc'=>$this->desc
        ]);
    }
}
