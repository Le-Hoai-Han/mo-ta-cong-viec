<?php

namespace App\Http\Controllers;

use App\Models\MoTaCongViec;
use App\Models\MoTaNhiemVu;
use App\Models\NhiemVu;
use App\Models\Vitri;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MoTaNhiemVuController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listMoTaNhiemVu = MoTaNhiemVu::all();
        return view('back-end.mo-ta-nhiem-vu.index',[
            'listMoTaNhiemVu' => $listMoTaNhiemVu
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listNhiemVu = NhiemVu::select(['id','ten_nhiem_vu'])->get();
        $nhiemVuHT = NhiemVu::find(1);
        return view('back-end.mo-ta-nhiem-vu.create',[
            'listNhiemVu' => $listNhiemVu,
            'nhiemVuHT' => $nhiemVuHT,
        ]);
    }

    public function createFront($nhiemVu)
    {
        $listNhiemVu = NhiemVu::select(['id','ten_nhiem_vu'])->get();
        $nhiemVuHT = NhiemVu::find($nhiemVu);
        return view('back-end.mo-ta-nhiem-vu.create',[
            'listNhiemVu' => $listNhiemVu,
            'nhiemVuHT' => $nhiemVuHT,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->__validate($request);

        $moTaNhiemVu = MoTaNhiemVu::create($validate);
        return redirect()->route('front.vi-tri.show',$moTaNhiemVu->nhiemVu->id_vi_tri)->with('success','Thêm thành công');
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
    public function edit(MoTaNhiemVu $moTaNhiemVu)
    {
        $listNhiemVu = NhiemVu::select(['id','ten_nhiem_vu'])->get();
        return view('back-end.mo-ta-nhiem-vu.edit',[
            'listNhiemVu' => $listNhiemVu,
            'moTaNhiemVu' => $moTaNhiemVu
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,MoTaNhiemVu $moTaNhiemVu)
    {
        $validate = $this->__validate($request);
        $moTaNhiemVu ->update($validate);
        return redirect()->route('front.vi-tri.show',$moTaNhiemVu->nhiemVu->id_vi_tri)->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MoTaNhiemVu $moTaNhiemVu)
    {
        $moTaNhiemVu->delete();
    }

    public function __validate($data){
        $validate = $this->validate($data, [
            'id_nhiem_vu' =>'required',
            'chi_tiet' => 'required',
            'ket_qua' => 'required',
            'mo_ta' => 'required'
        ],[
            'chi_tiet.required' => 'Vui lòng nhập chi tiết nhiệm vụ',
            'ket_qua.required' => 'Vui lòng nhập kết quả',
            'mo_ta.required' => 'Vui lòng nhập mô tả',
        ]);

        return $validate;
    }
}
