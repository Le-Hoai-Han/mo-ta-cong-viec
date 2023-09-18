<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ThamQuyen;
use App\Models\Vitri;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Validator;

class FrontThamQuyenController extends RoutingController
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
        ThamQuyen::create($validate);
        return redirect()->back()->with('success','Nhập thành công');
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
        $thamQuyen = ThamQuyen::find($id);
        $validate = $this->__validate($request->all());
        $thamQuyen->update($validate);
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
        $thamQuyen = ThamQuyen::find($id);
        $thamQuyen->delete();
        return response()->json([
            'status' =>'success',
            'message' =>'Xóa thành công',
        ]);
    }

    public function __validate($data){
        $validate = Validator::make($data, [
            'id_vi_tri' =>'required',
            'noi_dung' => 'required',
            'loai' => 'required',
        ],[
            'id_vi_tri.required' => 'Vui lòng chọn vị trí',
            'noi_dung.required' => 'Vui lòng nhập nội dung',
            'loai.required' => 'Vui lòng chọn loại',
        ]);
        return $validate->validate();
    }

    public function __getThamQuyen(Request $request){
        $thamQuyen = ThamQuyen::find($request->idThamQuyen);
        return [$thamQuyen,$thamQuyen->viTri];
    }
}
