<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ViTri extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $viTri;
    public $listViTri;
    public $listUser;
    public function __construct($viTri,$listViTri,$listUser)
    {
        $this->viTri = $viTri;
        $this->listViTri = $listViTri;
        $this->listUser = $listUser;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.vi-tri',[
            'viTri' => $this->viTri,
            'listViTri' => $this->listViTri,
            'listUser' => $this->listUser,
        ]);
    }
}
