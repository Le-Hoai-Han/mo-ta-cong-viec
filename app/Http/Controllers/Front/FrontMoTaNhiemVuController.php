<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MoTaNhiemVu;
use App\Models\NhiemVu;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Validator;

class FrontMoTaNhiemVuController extends RoutingController
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
        MoTaNhiemVu::create($validate);
        return response()->json([
            'status' => 'success',
            'message' => 'Thêm thành công',
        ]);
        
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
        $moTaNhiemVu = MoTaNhiemVu::find($id);
        $validate=$this->__validate($request->all());
        $moTaNhiemVu->update($validate);
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
        $mota = MoTaNhiemVu::find($id);
        $mota->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Xóa thành công',
        ]);
    }

    function __getTrachNhiem(Request $request){
        $trachNhiem = NhiemVu::find($request->idTrachNhiem);
        $moTa = MoTaNhiemVu::find($request->idMoTa);
        return [$trachNhiem,$moTa];
    }
    public function __validate($data){
        $validate = Validator::make($data, [
            'id_nhiem_vu' =>'required',
            'chi_tiet' => 'required',
            'ket_qua' => 'required',
            'mo_ta' => 'required'
        ],[
            'chi_tiet.required' => 'Vui lòng nhập chi tiết nhiệm vụ',
            'ket_qua.required' => 'Vui lòng nhập kết quả',
            'mo_ta.required' => 'Vui lòng nhập mô tả',
        ]);

        return $validate->validate();
    }
}
