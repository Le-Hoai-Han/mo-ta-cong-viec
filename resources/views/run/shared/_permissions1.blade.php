<div class="card my-3">
    <div class="card-header d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center " role="tab" id="{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}">
        <h4 class="mb-0">
            <a role="button" data-bs-toggle="collapse" href="#dd-{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}" aria-expanded="{{ isset($closed) ? 'true' : 'false' }}" aria-controls="dd-{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}">
                <!-- {{ $title ?? 'Override Permissions' }} {!! isset($user) ? '<span class="text-danger">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!} -->
                {{ $title ?? 'Override Permissions' }} {!! isset($user) ? '<span class="text-danger">(' . $role->permissions->count() . ')</span>' : '' !!}
            </a>
        </h4>
        @if (Route::currentRouteName() == "roles.index")
            
            <div class="btn-toolbar mb-2 mb-md-0">
                @can('edit_roles')
                <div class="btn-group mr-2">
                    <a href="{{route('roles.edit',$role)}}" class='btn btn-primary btn-sm'>Cập nhật</a>               

                </div>
                @endcan
                @can('delete_roles')
                <div class="btn-group mr-2">
                    <form action="{{route('roles.destroy',$role)}}" method="POST" style="display:none">
                        @csrf
                        @method('DELETE')
                    
                    <button type="submit" onclick="return confirm('Xác nhận xóa?')" class='btn btn-danger btn-sm'>Xóa</button> 
                    </form>      
                </div>
           
            </div>
            @endcan
            
            {{-- <button type="submit" class="btn btn-behance">Save</button> --}}
        @endif  
        
        
    </div>
    <form action ="{{ route('roles.update',$role)}}" method="POST" >
        @method("PUT")
        @csrf  
    <div id="dd-{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}" class="card-collapse collapse {{ $closed ?? 'in' }}" role="tabcard" aria-labelledby="dd-{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}">
        <div class="card-body">
            <?php $i = 0; ?>
            
            <div class="row">
                 
                @foreach($permissions as $perm)
                <?php


                $per_found = null;
                if (isset($role)) {
                    $per_found = $role->hasPermissionTo($perm->name);
                }

                if (isset($user)) {
                    $per_user_found = $user->hasDirectPermission($perm->name);
                }
                ?>

                <div class="col">
                    <div class="checkbox">
                        <label class="{{ Str::contains($perm->name, 'delete') ? 'text-red-700' : '' }}">

                            <input type="checkbox" name="permissions[]" value="{{$perm->name}}" @if($per_found == true || $per_user_found == true) checked @endif {{-- {{ (isset($options) ? $options : []) }} --}} id=""> {{ $perm->name}}
                            {{-- {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : []) !!} {{ $perm->name }} --}}
                        </label>
                    </div>
                </div>
                <?php
                $i++;
                if ($i == 4) {
                    $i = 0;
                    echo "</div><div class='row'>";
                }
                ?>
                @endforeach
      
            </div>
            
            @can('edit_roles')
                @if (Route::currentRouteName() == "roles.index")
                    <button type="submit" class="btn btn-behance">Save</button>
                @endif                
            @endcan
        </div>
    </div>
</form>
</div>