<?php 
$current = "Vị trí";

?>

<x-dashboard-layout :current="$current">
    <x-slot name="title">Edit vị trí</x-slot>

    <?php 
    $list = [
        '/'=>'Trang chủ',
        route('vi-tri.index')=>'Danh sách vị trí'
    ]
    ?> 
    <div class="main-div">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit vị trí</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('vi-tri.update',$viTri)}}" method="POST">
                        @csrf
                        @method('PUT')      
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="label" for="ten_vi_tri">
                                        Tên vị trí
                                    </label>
                                    <input class="form-control" 
                                        id="name" 
                                        name="ten_vi_tri" 
                                        type="text" 
                                        placeholder="Tên vị trí"                        
                                        value="{!! old('ten_vi_tri', $viTri->ten_vi_tri) !!}"
                                    >
                                    @error('ten_vi_tri')
                                        <span class="help text-red-500"> {{ $message}}</span>
                                    @enderror
                                </div>
                            </div>  
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="label" for="phong_ban">
                                        Phòng ban
                                    </label>
                                    <input class="form-control" 
                                        id="name" 
                                        name="phong_ban" 
                                        type="text" 
                                        placeholder="Tên phòng ban"                        
                                        value="{!! old('phong_ban',  $viTri->phong_ban) !!}"
                                    >
                                    @error('phong_ban')
                                        <span class="help text-red-500"> {{ $message}}</span>
                                    @enderror
                                </div>
                            </div>  
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="label" for="noi_lam_viec">
                                        Vị trí cấp trên
                                    </label>
                                    <select name="id_vi_tri_quan_ly" id="" class="form-control">
                                        @foreach($listViTri as $item)
                                        <option <?php echo $viTri->capQuanLy->id == $item->id ?'selected':' '?> value="{{$item->id}}">{{$item->ten_vi_tri}}</option>
                                        @endforeach
                                    </select>
                                    @error('id_vi_tri_quan_ly')
                                        <span class="help text-red-500"> {{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="label" for="id_user">
                                        User
                                    </label>
                                   <select name="id_user" id="" class="form-control">
                                    @foreach($listUser as $user)
                                    <option {{$viTri->user->id == $user->id ? 'selected' :''}} value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                   </select>
                                    @error('id_user')
                                        <span class="help text-red-500"> {{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="label" for="noi_lam_viec">
                                        Nơi làm việc
                                    </label>
                                    <input class="form-control" 
                                        id="name" 
                                        name="noi_lam_viec" 
                                        type="text" 
                                        placeholder="Nơi làm việc"                        
                                        value="{!! old('noi_lam_viec',  $viTri->noi_lam_viec) !!}"
                                    >
                                    @error('noi_lam_viec')
                                        <span class="help text-red-500"> {{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="mb-4">
                                    <label class="label" for="muc_dich">
                                        Mục đích
                                    </label>
                                    <textarea rows="5" class="form-control" 
                                        id="name" 
                                        name="muc_dich" 
                                        type="text" 
                                        placeholder="Mục đích"                        
                                        value=""
                                    >{!! old('muc_dich', $viTri->muc_dich) !!}</textarea>
                                    @error('muc_dich')
                                        <span class="help text-red-500" style="color:Red"> {{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <button class="btn btn-primary">Lưu</button>
                                <a href="{{url()->previous()}}" class="btn btn-secondary">Hủy</a>
                            </div>
                        </div>            
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-dashboard-layout>