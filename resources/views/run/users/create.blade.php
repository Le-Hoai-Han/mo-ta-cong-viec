<x-dashboard-layout>
    <x-slot name="title">Thêm thành viên</x-slot>
  
    <?php 
    $list = [
            '/'=>'Trang chủ',
            route('users.index')=>'Danh sách người dùng',
            '#'=>'Thêm mới'
        ];
    ?>
    <div class="row">
            <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-8">Danh sách users</div>
                        </div>
                        <div class="card-body">
                            <div class="row cols-xs-12">
                            
                                <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf                  
                                    <div class="mb-4">
                                        <label class="label" for="name">
                                            Tên đăng nhập
                                        </label>
                                        <input class="form-control" 
                                            id="name" 
                                            name="name" 
                                            type="text" 
                                            placeholder="Tên đăng nhập"                        
                                            value="{!! old('name')!!}"
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
                                            value="{!! old('email') !!}"
                                        >
                                        @error('email')
                                            <span class="help text-red-500"> {{ $message}}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="label" for="password">
                                            Mật khẩu
                                        </label>
                                        <input class="form-control" 
                                            id="password" 
                                            name="password" 
                                            type="password" 
                                            placeholder="Mật khẩu"                        
                                            value="{!! old('password') !!}"
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
                                            Ảnh đại diện
                                        </label>
                                        <input class="form-control" 
                                            id="photo_file_path" 
                                            name="photo_file_path" 
                                            type="file" 
                                            placeholder="Ảnh đại diện"                        
                                            
                                        >
                                        @error('photo_file_path')
                                            <span class="help text-red-500"> {{ $message}}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="label" for="roles">
                                            Nhóm quyền
                                        </label>
                                        <?php //$userRole = $user->getRoleNames()->toArray();?>
                                        <select multiple="multiple" name="roles[]" class="form-control">
                                            @foreach ($roles as $roleId=>$roleName)
                                                <option value="{{ $roleId}}" >{{ $roleName }}</option>
                                            @endforeach
                                        </select>
                                            {{-- {!! Form::select('roles[]', $roles, isset($user) ? $user->roles->pluck('id')->toArray() : null,  ['class' => 'form-control', 'multiple']) !!} --}}
                                            @if ($errors->has('roles')) <p class="help-block">{{ $errors->first('roles') () }}</p> @endif
                                    </div>  
                                        {{-- <!-- Permissions -->
                                            @if(isset($user))
                                            @include('shared._permissions1', ['closed' => 'true', 'model' => $user ,'title'=>'Quyền cá nhân'])
                                            @endif  --}}
                                    <div class="mb-4">
                                        <button class="btn btn-primary">Cập nhật</button>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
    </div>

    
</x-dashboard-layout>