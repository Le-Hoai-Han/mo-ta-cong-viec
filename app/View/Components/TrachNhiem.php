<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TrachNhiem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $nhiemVu;
    public $listViTri;
    public $viTriHienTai;
    public function __construct($nhiemVu,$listViTri,$viTriHienTai)
    {
        $this->nhiemVu   =  $nhiemVu;
        $this->listViTri = $listViTri;
        $this->viTriHienTai = $viTriHienTai;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.trach-nhiem',[
            'nhiemVu' => $this->nhiemVu,
            'listViTri' => $this->listViTri,
            'viTriHienTai' => $this->viTriHienTai,
        ]);
    }
}
