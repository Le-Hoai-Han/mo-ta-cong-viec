<?php 
$current = "User";

?>

<x-dashboard-layout :current="$current">
    <x-slot name="title">Thêm user</x-slot>

    <?php 
    $list = [
        '/'=>'Trang chủ',
        route('vi-tri.index')=>'Danh sách user'
    ]
    ?> 
    <div class="main-div">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Thêm user</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('users.store')}}" method="POST">
                        @csrf                  
                            <div class="mb-4">
                                <label class="label" for="name">
                                    Họ và tên
                                </label>
                                <input class="form-control" 
                                    id="name" 
                                    name="name" 
                                    type="text" 
                                    placeholder="Họ và tên"                        
                                    value="{!! old('name', '') !!}"
                                >
                                @error('name')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="label" for="email">
                                   Email
                                </label>
                                <input class="form-control" 
                                    id="email" 
                                    name="email" 
                                    type="email" 
                                    placeholder="Email"                        
                                    value="{!! old('email', '') !!}"
                                >
                                @error('email')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="label" for="password">
                                   Password
                                </label>
                                <input class="form-control" 
                                    id="password" 
                                    name="password" 
                                    type="password" 
                                    placeholder="Password"                        
                                    value="{!! old('password', '') !!}"
                                >
                                @error('password')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="label" for="sdt">
                                    Số điện thoại
                                </label>
                                <input class="form-control" 
                                    id="sdt" 
                                    name="sdt" 
                                    type="text" 
                                    placeholder="Số điện thoại"                        
                                    value="{!! old('sdt', '') !!}"
                                >
                                @error('sdt')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="label" for="photo_file_path">
                                    photo_file_path
                                </label>
                                <input class="form-control" 
                                id="photo_file_path" 
                                name="profile_photo_url" 
                                type="file" 
                                placeholder="photo_file_path"                        
                                value="{!! old('photo_file_path', '') !!}"
                            >
                                @error('photo_file_path')
                                    <span class="help text-red-500"> {{ $message}}</span>
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
    
</x-dashboard-layout>