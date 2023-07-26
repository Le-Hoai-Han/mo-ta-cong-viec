<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TrangThaiKhoaSwitch extends Component
{
    protected $label1 = '';
    protected $label2 = '';
    protected $url1 = '';
    protected $url2 = '';
    protected $active = '';
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($url1,$label1,$url2,$label2,$active)
    {
        $this->label1 = $label1;
        $this->label2 = $label2;
        $this->url1 = $url1;
        $this->url2 = $url2;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.trang-thai-khoa-switch',[
            'label1'=>$this->label1,
            'label2'=>$this->label2,
            'url1'=>$this->url1,
            'url2'=>$this->url2,
            'active'=>$this->active,
        ]);
    }
}
