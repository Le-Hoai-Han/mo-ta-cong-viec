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
        if($request->thai_do){
            ASK::create([
                'id_vi_tri' => $request->id_vi_tri,
                'noi_dung' => $request->thai_do,
                'loai' => ASK::THAI_DO,
            ]);
        }

        if($request->ky_nang){
            ASK::create([
                'id_vi_tri' => $request->id_vi_tri,
                'noi_dung' => $request->ky_nang,
                'loai' => ASK::KY_NANG,
            ]);
        }

        if($request->kien_thuc){
            ASK::create([
                'id_vi_tri' => $request->id_vi_tri,
                'noi_dung' => $request->kien_thuc,
                'loai' => ASK::KIEN_THUC,
            ]);
        }
        return response()->json(['success' => true, 'message' => 'Cập nhật thành công']);
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
        $ASK->update([
            'noi_dung' => $request->value
        ]);
        return response()->json(['success' => true, 'message' => 'Cập nhật thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
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
