<x-dashboard-layout>
    <x-slot name="title">Cập nhật thành viên</x-slot>

    <?php
    $list = [
        '/' => 'Trang chủ',
        route('users.index') => 'Danh sách thành viên',
        route('users.show', $user) => $user->name,
        'Cập nhật',
    ];
    ?>


    <div class="main-div">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Sửa users</h6>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach

                            </div><br>
                        @endif

                        @if (Session::has('error'))
                            <div style="color:white" class="alert alert-danger">{{ Session::get('error') }}</div>
                        @endif


                        <div class="d-flex justify-content-between  border-bottom mb-3">

                            @can('add_users')
                                <a class="text-secondary" href="{{ route('users.create') }}" title="Thêm người dùng">
                                    <span class="material-icons">
                                        add
                                    </span>
                                </a>
                            @endcan
                        </div>
                        <form action="{{ route('users.update', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="label" for="name">
                                    Tên đầy đủ
                                </label>
                                <input class="form-control" id="name" name="name" type="text"
                                    placeholder="Tên đầy đủ" value="{!! old('name', optional($user)->name) !!}">
                                @error('name')
                                    <span class="help text-red-500"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="label" for="password">
                                    Mật khẩu
                                </label>
                                <input class="form-control" id="password" name="password" type="password"
                                    placeholder="Mật khẩu" value="">
                                @error('password')
                                    <span class="help text-red-500"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="label" for="email">
                                    Email
                                </label>
                                <input class="form-control" id="email" name="email" type="email"
                                    placeholder="Email" value="{!! old('email', optional($user)->email) !!}">
                                @error('name')
                                    <span class="help text-red-500"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="label" for="sdt">
                                    Số điện thoại
                                </label>
                                <input class="form-control" id="sdt" name="sdt" type="text"
                                    placeholder="Số điện thoại" value="{!! old('sdt', $user->sdt) !!}">
                                @error('sdt')
                                    <span class="help text-red-500"> {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="label">
                                    Trạng thái
                                </label>
                                <select class="form-control" name="status">
                                    @if ($user->status == 1)
                                        <option selected value="1">Tài khoản mở</option>
                                        <option value="0">Khóa tài khoản</option>
                                    @else()
                                        <option value="1">Tài khoản mở</option>
                                        <option selected value="0">Khóa tài khoản</option>
                                    @endif

                                </select>
                                @error('name')
                                    <span class="help text-red-500"> {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="label" for="photo_file_path">
                                    Ảnh đại diện
                                </label>
                                <input class="form-control" id="photo_file_path" name="photo_file_path" type="file"
                                    placeholder="Ảnh đại diện">
                                @error('photo_file_path')
                                    <span class="help text-red-500"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="label" for="roles">
                                    Nhóm quyền
                                </label>
                                <?php $userRole = $user->getRoleNames()->toArray(); ?>

                                <select multiple="multiple" name="roles[]" class="form-control">
                                    @foreach ($roles as $roleId => $roleName)
                                        <option value="{{ $roleId }}"
                                            {{ in_array($roleName, $userRole) ? 'selected' : '' }}>{{ $roleName }}
                                        </option>
                                    @endforeach
                                </select>
                                {{-- {!! Form::select('roles[]', $roles, isset($user) ? $user->roles->pluck('id')->toArray() : null,  ['class' => 'form-control', 'multiple']) !!} --}}
                                @if ($errors->has('roles'))
                                    <p class="help-block">{{ $errors->first('roles')() }}</p>
                                @endif
                            </div>
                            <!-- Permissions -->

                            @if (isset($user))
                                @include('run.users._permissions1', [
                                    'closed' => 'true',
                                    'model' => $user,
                                    'title' => 'Quyền cá nhân',
                                ])
                            @endif
                            <div class="mb-4">
                                <button class="btn btn-primary">Cập nhật</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


</x-dashboard-layout>
