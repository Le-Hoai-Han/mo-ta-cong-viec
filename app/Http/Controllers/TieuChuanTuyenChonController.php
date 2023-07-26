<?php

namespace App\Http\Controllers;

use App\Models\TieuChuanTuyenChon;
use App\Models\Vitri;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TieuChuanTuyenChonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     use ValidatesRequests;
    public function index()
    {
        $listTieuChuan = TieuChuanTuyenChon::all();
        return view('back-end.tieu-chuan.index',[
            'listTieuChuan' => $listTieuChuan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listViTri = Vitri::select(['id','ten_vi_tri'])->get();
        return view('back-end.tieu-chuan.create',[
            'listViTri' => $listViTri
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

        TieuChuanTuyenChon::create($validate);
        return redirect()->route('tieu-chuan.index')->with('Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TieuChuanTuyenChon $tieuChuan)
    {
        $listViTri = Vitri::select(['id','ten_vi_tri'])->get();
        return view('back-end.tieu-chuan.show',[
            'listViTri' => $listViTri,
            'tieuChuan' => $tieuChuan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TieuChuanTuyenChon $tieuChuan)
    {
        $listViTri = Vitri::select(['id','ten_vi_tri'])->get();
        return view('back-end.tieu-chuan.edit',[
            'listViTri' => $listViTri,
            'tieuChuan' => $tieuChuan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TieuChuanTuyenChon $tieuChuan)
    {
        $validate = $this->__validate($request);
        $tieuChuan->update($validate);
        return redirect()->route('tieu-chuan.index')->with('success','Cập nhật thành công');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TieuChuanTuyenChon $tieuChuan)
    {
        $tieuChuan->delete();
    }

    public function __validate($data){
        $validate = $this->validate($data, [
            'id_vi_tri' =>'required',
            'gioi_tinh' => 'required',
            'tuoi' => 'required',
            'hoc_van' => 'required',
            'chuyen_mon' => 'required',
            'vi_tinh' => 'required',
            'anh_ngu' => 'required',
            'kinh_nghiem' => 'required',
            'ky_nang' => 'required',
            'to_chat' => 'required',
            'ngoai_hinh' => 'required',
            'suc_khoe' => 'required',
            'ho_khau' => 'required',
            'uu_tien' => 'required',
        ],[
            'id_vi_tri.required' => 'Vui lòng chọn vị trí',
            'gioi_tinh.required' => 'Vui lòng nhập giới tính',
            'tuoi.required' => 'Vui lòng nhập tuổi',
            'hoc_van.required' => 'Vui lòng nhập học ván',
            'chuyen_mon.required' => 'Vui lòng nhập chuyên môn',
            'vi_tinh.required' => 'Vui lòng nhập vi tính',
            'anh_ngu.required' => 'Vui lòng nhập anh ngữ',
            'kinh_nghiem.required' => 'Vui lòng nhập kinh nghiệm',
            'ky_nang.required' => 'Vui lòng nhập kỹ năng',
            'to_chat.required' => 'Vui lòng nhập tố chất ',
            'ngoai_hinh.required' => 'Vui lòng nhập ngoại hình',
            'suc_khoe.required' => 'Vui lòng nhập tình trạng sức khỏe',
            'ho_khau.required' => 'Vui lòng nhập hộ khẩu',
            'uu_tien.required' => 'Vui lòng nhập ưu tiên',
            
        ]);


        return $validate;
    }
}
