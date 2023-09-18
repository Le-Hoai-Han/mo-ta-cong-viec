<?php 
$current = "Tiêu chuẩn";

?>

<x-dashboard-layout :current="$current">
    <x-slot name="title">Tiêu chuẩn</x-slot>

    <?php 
    $list = [
        '/'=>'Trang chủ',
        route('tieu-chuan.index')=>'Danh sách tiêu chuẩn'
    ]
    ?> 
    <div class="main-div">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Tiêu chuẩn</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('tieu-chuan.update', $tieuChuan)}}" method="POST">
                        @csrf
                        @method('PUT')  
                        <div class="row">

                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="label" for="ten_nhiem_vu">
                                        Vị trí
                                    </label>
                                    <select name="id_vi_tri" class="form-control">
                                        @foreach($listViTri as $viTri)
                                        <option {{$viTri->id == $tieuChuan->viTri->id ?'selected':''}} value="{{$viTri->id}}">{{$viTri->ten_vi_tri}}</option>
                                        @endforeach
                                    </select>
                                    @error('id_vi_tri')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>
    
                                <div class="mb-4">
                                    <label class="label" for="gioi_tinh">
                                        Giới tính 
                                    </label>
                                    <select class="form-control" name="gioi_tinh">
                                        <option {{ $tieuChuan->gioi_tinh == 1 ?'selected':''}} value="Nam">Nam</option>
                                        <option {{ $tieuChuan->gioi_tinh == 2 ?'selected':''}} value="Nữ">Nữ</option>
                                    </select>
                                    @error('gioi_tinh')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>
    
                                <div class="mb-4">
                                    <label class="label" for="tuoi">
                                        Tuổi
                                    </label>
                                    <textarea rows="1" class="form-control" 
                                    id="tuoi" 
                                    name="tuoi" 
                                    type="text" 
                                    placeholder="Tuổi"                        
                                    value="">{!! old('tuoi',$tieuChuan->tuoi) !!}</textarea>
                                    @error('tuoi')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>
    
                            </div>
                            <div class="col-md-4">
                                
                                <div class="mb-4">
                                    <label class="label" for="hoc_van">
                                        Học vấn 
                                    </label>
                                    <textarea rows="2" class="form-control" 
                                    id="hoc_van" 
                                    name="hoc_van" 
                                    type="text" 
                                    placeholder="Học vấn"                        
                                    value="">{!! old('hoc_van',$tieuChuan->hoc_van) !!}</textarea>
                                    @error('hoc_van')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>
        
                                <div class="mb-4">
                                    <label class="label" for="chuyen_mon">
                                        Chuyên môn 
                                    </label>
                                    <textarea rows="2" class="form-control" 
                                    id="chuyen_mon" 
                                    name="chuyen_mon" 
                                    type="text" 
                                    placeholder="Chuyên môn"                        
                                    value=""
                                >{!! old('chuyen_mon',$tieuChuan->chuyen_mon) !!}</textarea>
                                    @error('chuyen_mon')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>
        
                                <div class="mb-4">
                                    <label class="label" for="vi_tinh">
                                        Vi tính 
                                    </label>
                                    <textarea rows="2" class="form-control" 
                                    id="vi_tinh" 
                                    name="vi_tinh" 
                                    type="text" 
                                    placeholder="Vi tính"                        
                                    value=""
                                >{!! old('vi_tinh',$tieuChuan->vi_tinh) !!}</textarea>
                                    @error('vi_tinh')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>
                            </div>     
                            <div class="col-md-4">

                                
                                <div class="mb-4">
                                    <label class="label" for="anh_ngu">
                                        Anh ngữ 
                                    </label>
                                    <textarea rows="2" class="form-control" 
                                    id="anh_ngu" 
                                    name="anh_ngu" 
                                    type="text" 
                                    placeholder="Anh ngữ"                        
                                    value=""
                                >{!! old('anh_ngu',$tieuChuan->anh_ngu) !!}</textarea>
                                    @error('anh_ngu')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>
    
                                <div class="mb-4">
                                    <label class="label" for="kinh_nghiem">
                                        Kinh nghiệm 
                                    </label>
                                    <textarea rows="2" class="form-control" 
                                    id="kinh_nghiem" 
                                    name="kinh_nghiem" 
                                    type="text" 
                                    placeholder="Kinh nghiệm"                        
                                    value=""
                                >{!! old('kinh_nghiem',$tieuChuan->kinh_nghiem) !!}</textarea>
                                    @error('kinh_nghiem')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>
    
                                <div class="mb-4">
                                    <label class="label" for="ky_nang">
                                        Kỹ năng 
                                    </label>
                                    <textarea rows="2" class="form-control" 
                                    id="ky_nang" 
                                    name="ky_nang" 
                                    type="text" 
                                    placeholder="Kỹ năng"                        
                                    value=""
                                >{!! old('ky_nang',$tieuChuan->ky_nang) !!}</textarea>
                                    @error('ky_nang')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>
                            </div>     
                            <div class="col-md-4">

                                <div class="mb-4">
                                    <label class="label" for="to_chat">
                                        Tố chất 
                                    </label>
                                    <textarea rows="2" class="form-control" 
                                    id="to_chat" 
                                    name="to_chat" 
                                    type="text" 
                                    placeholder="Tố chất"                        
                                    value=""
                                >{!! old('to_chat',$tieuChuan->to_chat) !!}</textarea>
                                    @error('to_chat')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>
        
                                <div class="mb-4">
                                    <label class="label" for="ngoai_hinh">
                                        Ngoại hình 
                                    </label>
                                    <textarea rows="2" class="form-control" 
                                    id="ngoai_hinh" 
                                    name="ngoai_hinh" 
                                    type="text" 
                                    placeholder="Ngoại hình"                        
                                    value=""
                                >{!! old('ngoai_hinh',$tieuChuan->ngoai_hinh) !!}</textarea>
                                    @error('ngoai_hinh')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>
        
                                <div class="mb-4">
                                    <label class="label" for="suc_khoe">
                                        Sức khỏe 
                                    </label>
                                    <textarea rows="2" class="form-control" 
                                    id="suc_khoe" 
                                    name="suc_khoe" 
                                    type="text" 
                                    placeholder="Sức khỏe"                        
                                    value=""
                                >{!! old('suc_khoe',$tieuChuan->suc_khoe) !!}</textarea>
                                    @error('suc_khoe')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>
        
                                
                            </div>  
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="label" for="ho_khau">
                                        Hộ khẩu 
                                    </label>
                                    <textarea rows="2" class="form-control" 
                                    id="ho_khau" 
                                    name="ho_khau" 
                                    type="text" 
                                    placeholder="Hộ khẩu"                        
                                    value=""
                                >{!! old('ho_khau',$tieuChuan->ho_khau) !!}</textarea>
                                    @error('ho_khau')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>
        
                                <div class="mb-4">
                                    <label class="label" for="uu_tien">
                                        Ưu tiên 
                                    </label>
                                    <textarea rows="2" class="form-control" 
                                    id="uu_tien" 
                                    name="uu_tien" 
                                    type="text" 
                                    placeholder="Ưu tiên"                        
                                    value=""
                                >{!! old('uu_tien',$tieuChuan->uu_tien) !!}</textarea>
                                    @error('uu_tien')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>
                            </div>    
                        </div>



                            <div class="mb-4">
                                <button class="btn btn-primary">Lưu</button>
                                <a href="{{url()->previous()}}" class="btn btn-secondary">Hủy</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-dashboard-layout>