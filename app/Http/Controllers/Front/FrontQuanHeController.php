<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\QuanHe;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Validator;

class FrontQuanHeController extends RoutingController
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
        if($request->ben_trong){
                QuanHe::create([
                    'id_vi_tri' => $request->id_vi_tri,
                    'noi_dung' => $request->ben_trong,
                    'loai' => QuanHe::BEN_TRONG,
                ]);
        }

        if($request->ben_ngoai){
                QuanHe::create([
                    'id_vi_tri' => $request->id_vi_tri,
                    'noi_dung' => $request->ben_ngoai,
                    'loai' => QuanHe::BEN_NGOAI,
                ]);
            }
            return response()->json(['success' => true, 'message' => 'Thêm thành công']);
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
        $quanHe = QuanHe::find($id);
        $quanHe->update([
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
        $quanHe = QuanHe::find($id);
        $quanHe->delete();
        return response()->json([
            'status' =>'success',
            'message' =>'Xóa thành công',
        ]);
    }

    public function __validate($data){
        $validate = Validator::make($data,[
            'id_vi_tri'=>'required',
            'loai'=>'required',
            'noi_dung'=>'required',
        ],[
            'id_vi_tri.required' =>'Vị trí không được để trống',
            'loai.required' =>'Vị trí không được để trống',
            'noi_dung.required' =>'Vị trí không được để trống',
        ]);

        return $validate->validate();
    }

    public function __getQuanHe(Request $request){
        $quanHe = QuanHe::find($request->idQuanHe);
        return [$quanHe,$quanHe->viTri];
    }
}
