<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ASK;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Validator;

class ASKController extends RoutingController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validate = $this->__validate($request->all());
        ASK::create($validate);
        return redirect()->route('front.vi-tri.show',$validate['id_vi_tri'])->with('success','Thêm thành công');
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
        $ASK = ASK::find($id);
        $validate = $this->__validate($request->all());
        $ASK->update($validate);
        return redirect()->back()->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ASK = ASK::find($id);
        $ASK->delete();
        return response()->json([
            'status' =>'success',
            'message' =>'Xóa thành công',
        ]);
    }

    public function __validate($data){
        $validate = Validator::make($data, [
            'id_vi_tri'=>'required',
            'loai' =>'nullable',
            'noi_dung' =>'nullable',
        ]);

        return $validate->validate();
    }

    public function __getASK(Request $request){
        $ASK = ASK::find($request->idASK);
        return [$ASK,$ASK->viTri];
    }
}
