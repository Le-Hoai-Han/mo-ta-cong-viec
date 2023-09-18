  <!-- The Modal -->
  <div id="model-edit-user" class="modal">

      <!-- Modal content -->
      <div class="modal-content">
          <span class="close" id="close_user_edit">&times;</span>
          <div class="row">
              <div class="col-xs-12">
                  <div class="card">
                      <div class="card-header pb-0 p-3">
                          <div class="row">
                              <div class="col-6 d-flex align-items-center">
                                  <h6 class="mb-0">Cập nhật nhân viên</h6>
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


                          
                          @if( $viTri->user != null)
                          <form action="{{ route('front-user.update', $viTri->user->id) }}" method="POST"
                              enctype="multipart/form-data">
                              @csrf
                              @method('PUT')
                              <div class="mb-4">
                                  <label class="label" for="name">
                                      Tên đầy đủ
                                  </label>
                                  <input class="form-control" id="name" name="name" type="text"
                                      placeholder="Tên đầy đủ" value="{!! old('name', $viTri->user->name) !!}">
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
                                      placeholder="Email" value="{!! old('email',$viTri->user->email) !!}">
                                  @error('name')
                                      <span class="help text-red-500"> {{ $message }}</span>
                                  @enderror
                              </div>
                              <div class="mb-4">
                                  <label class="label" for="sdt">
                                      Số điện thoại
                                  </label>
                                  <input class="form-control" id="sdt" name="sdt" type="text"
                                      placeholder="Số điện thoại" value="{!! old('sdt',$viTri->user->sdt) !!}">
                                  @error('sdt')
                                      <span class="help text-red-500"> {{ $message }}</span>
                                  @enderror
                              </div>

                              <div class="mb-4">
                                  <label class="label">
                                      Trạng thái
                                  </label>
                                  <select class="form-control" name="status">
                                      @if (($viTri->user != null ? $viTri->user->status == 1 :''))
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
                                  <?php $userRole = $viTri->user->getRoleNames()->toArray();?>

                                  <select multiple="multiple" name="roles[]" class="form-control">
                                      @foreach ($roles as $roleId => $roleName)
                                          <option value="{{ $roleId }}"
                                              {{ in_array($roleName, $userRole) ? 'selected' : '' }}>
                                              {{ $roleName}}
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
                          @else
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
                          @endif

                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  @push('scripts')
<script>
    var btnEditUser = document.getElementById('edit-user');
    var modalEditUser = document.getElementById('model-edit-user');

    var btnCloseModalEditUser = document.getElementById('close_user_edit');

  if(btnEditUser != null){
      btnEditUser.addEventListener("click",function(){
          openModal(modalEditUser);
      })

  }

    btnCloseModalEditUser.addEventListener("click",function(){
        closeModal(modalEditUser);
    })


    function openModal(modal){
        modal.classList.add('show');
    }

    function closeModal(modal){
        modal.classList.remove('show');
    }
</script>
@endpush