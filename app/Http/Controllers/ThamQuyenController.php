<?php

namespace App\Http\Controllers;

use App\Models\ThamQuyen;
use App\Models\Vitri;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ThamQuyenController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listThamQuyen = ThamQuyen::all();
        return view('back-end.tham-quyen.index',[
            'listThamQuyen' => $listThamQuyen
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listViTri = ViTri::select(['id','ten_vi_tri'])->get();
        return view('back-end.tham-quyen.create',[
            'listViTri'=>$listViTri
        ]);
    }

    public function createFront($viTri)
    {
        $listViTri = ViTri::select(['id','ten_vi_tri'])->get();
        $viTriHT = Vitri::find($viTri);
        return view('back-end.tham-quyen.create',[
            'listViTri' => $listViTri,
            'viTriHT' => $viTriHT,
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

        ThamQuyen::create($validate);
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ThamQuyen $thamQuyen)
    {
        $listViTri = ViTri::select(['id','ten_vi_tri'])->get();
        return view('back-end.tham-quyen.edit',[
            'listViTri'=>$listViTri,
            'thamQuyen' => $thamQuyen
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ThamQuyen $thamQuyen,Request $request)
    {
       $validate = $this->__validate($request);
       $thamQuyen->update($validate);
       return redirect()->route('front.vi-tri.show',$validate['id_vi_tri'])->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ThamQuyen $thamQuyen)
    {
        $thamQuyen->delete();
        return redirect()->route('tham-quyen.index')->with('success','Đã xóa');
    }
    public function __validate($data){
        $validate = $this->validate($data, [
            'id_vi_tri' =>'required',
            'noi_dung' => 'required',
            'loai' => 'required',
        ],[
            'id_vi_tri.required' => 'Vui lòng chọn vị trí',
            'noi_dung.required' => 'Vui lòng nhập nội dung',
            'loai.required' => 'Vui lòng chọn loại',
        ]);
        return $validate;
    }
}
