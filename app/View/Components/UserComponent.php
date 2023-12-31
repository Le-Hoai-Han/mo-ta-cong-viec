<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $viTri;
    public $roles;
    public function __construct($viTri,$roles)
    {
        $this->viTri = $viTri;
        $this->roles = $roles;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-component',[
            'viTri' => $this->viTri,
            'roles' => $this->roles,
        ]);
    }
}
