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

        MoTaNhiemVu::create([
            'id_nhiem_vu' => $request->id_nhiem_vu,
            'chi_tiet' => $request->chi_tiet,
            'ket_qua' => $request->ket_qua,
        ]);
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
        $moTaNhiemVu = MoTaNhiemVu::find($id);

        if (!$moTaNhiemVu) {
            return redirect()->back()->with('error', 'Không tìm thấy nhiệm vụ!');
        }
        if($request->field == 'chi_tiet'){
            $moTaNhiemVu->update(['chi_tiet' => $request->value]);
        }
        if($request->field == 'ket_qua'){
            $moTaNhiemVu->update(['ket_qua' => $request->value]);
        }

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
        $moTa = MoTaNhiemVu::find($id);
        $moTa->delete();
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

}
