<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ASK extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $viTri;
    public $listViTri;
    public function __construct($viTri,$listViTri)
    {
        $this->viTri = $viTri;
        $this->listViTri = $listViTri;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.a-s-k',[
            'viTri' => $this->viTri,
            'listViTri' => $this->listViTri
        ]);
    }
}
