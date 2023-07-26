<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vitri;
use App\Traits\ViTriTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;

class UserController extends RoutingController
{
    use ViTriTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function getData(){
         $ceo = Vitri::find(2);
        
         $chartConfig = [
            'container' => '#basic-example',
            'connectors' => [
                'type' => 'step',
                
            ],
            'node' => [
                'HTMLclass' => 'nodeExample1'
            ]
        ];

        $nodeStructure = [
            'text' => [
                'name' => $ceo->user->name,
                'title' => $ceo->ten_vi_tri,
                'contact' => $ceo->user->sdt,
                
            ],
            'stackChildren' => $ceo->hien_thi_nhanh,
            'image' =>  asset('storage/'.$ceo->user->profile_photo_path),
            'HTMLid'=>'nhan-vien-' .$ceo->id,
            'children' => $ceo->soDoToChucCapDuoi($ceo),
        ];

        $chartJson = [
            'chart' => $chartConfig,
            'nodeStructure' => $nodeStructure
        ];
       return response()->json( $chartJson);

     }
    public function index()
    {
        return view('front.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
