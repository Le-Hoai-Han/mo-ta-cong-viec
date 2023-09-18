<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MoTaNhiemVu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $listNhiemVu;
    public $nhiemVuHienTai;
    public function __construct($listNhiemVu,$nhiemVuHienTai)
    {
        $this->listNhiemVu = $listNhiemVu;
        $this->nhiemVuHienTai = $nhiemVuHienTai;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.mo-ta-nhiem-vu',[
            'listNhiemVu' => $this->listNhiemVu,
            'nhiemVuHienTai' => $this->nhiemVuHienTai,
        ]);
    }
}
