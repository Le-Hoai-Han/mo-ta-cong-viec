<?php

namespace App\Http\Controllers\Front;

use Illuminate\Routing\Controller;
use App\Models\Vitri;
use Illuminate\Http\Request;

class ViTriController extends Controller
{
    public function show(Vitri $viTri) {
        return view('front.vitri.show',[
            'viTri' => $viTri
        ]);
    }
}
