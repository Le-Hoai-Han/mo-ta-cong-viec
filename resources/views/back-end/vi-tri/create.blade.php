<?php 
$current = "Vị trí";

?>

<x-dashboard-layout :current="$current">
    <x-slot name="title">Thêm vị trí</x-slot>

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
                        <h5>Thêm vị trí</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('vi-tri.store')}}" method="POST">
                        @csrf                  
                            <div class="mb-4">
                                <label class="label" for="ten_vi_tri">
                                    Tên vị trí
                                </label>
                                <input class="form-control" 
                                    name="ten_vi_tri" 
                                    type="text" 
                                    placeholder="Tên vị trí"                        
                                    value="{!! old('ten_vi_tri', '') !!}"
                                >
                                @error('ten_vi_tri')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="label" for="ten_vi_tri">
                                    Tên user
                                </label>
                                <select name="id_user" id="tom-select-it" class="form-control">
                                    @foreach($listUser as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                    <option value="0">null</option>
                                </select>
                                @error('id_user')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="label" for="phong_ban">
                                    Phòng ban
                                </label>
                                <input class="form-control" 
                                    name="phong_ban" 
                                    type="text" 
                                    placeholder="Tên phòng ban"                        
                                    value="{!! old('phong_ban', '') !!}"
                                >
                                @error('phong_ban')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="label" for="noi_lam_viec">
                                    Nơi làm việc
                                </label>
                                <input class="form-control" 
                                    name="noi_lam_viec" 
                                    type="text" 
                                    placeholder="Nơi làm việc"                        
                                    value="{!! old('noi_lam_viec', '') !!}"
                                >
                                @error('noi_lam_viec')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="label" for="noi_lam_viec">
                                    Vị trí cấp trên
                                </label>
                                <select name="id_vi_tri_quan_ly" id="tom-select-it1" class="form-control">
                                    @foreach($listViTri as $viTri)
                                    <option value="{{$viTri->id}}">{{$viTri->ten_vi_tri}} - {{$viTri->user != null ?$viTri->user->name : 'Đang tuyển'}}</option>
                                    @endforeach
                                </select>
                                @error('id_vi_tri_quan_ly')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="label" for="muc_dich">
                                    Mục đích
                                </label>
                                <textarea rows="5" class="form-control" 
                                    name="muc_dich" 
                                    type="text" 
                                    placeholder="Mục đích"                        
                                    value="{!! old('muc_dich', '') !!}"
                                ></textarea>
                                @error('muc_dich')
                                    <span class="help text-red-500" style="color:Red"> {{ $message}}</span>
                                @enderror
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

    <script>
        var settings = {};
        new TomSelect('#tom-select-it',settings);

        var settings1 = {};
        new TomSelect('#tom-select-it1',settings);
    </script>
    
</x-dashboard-layout>