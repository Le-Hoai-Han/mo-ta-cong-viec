<div class="card my-3">
    <div class="card-header d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center " role="tab" id="{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}">
        <h4 class="mb-0">
            <a role="button" data-bs-toggle="collapse" href="#dd-{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}" aria-expanded="{{ isset($closed) ? 'true' : 'false' }}" aria-controls="dd-{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}">
                {{ $title ?? 'Override Permissions' }} {!! isset($user) ? '<span class="text-danger">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!}
            </a>
        </h4>
      
        
    </div>
   
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
                    $per_found = $user->hasDirectPermission($perm->name);
                }
                ?>

                <div class="col">
                    <div class="checkbox">
                        <label class="{{ Str::contains($perm->name, 'delete') ? 'text-red-700' : '' }}">

                            <input type="checkbox" name="permissions[]" value="{{$perm->name}}" @if($per_found) checked @endif {{-- {{ (isset($options) ? $options : []) }} --}} id=""> {{ $perm->name}}
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
                    <button type="submit" class="btn-blue">Save</button>
                @endif                
            @endcan
        </div>
    </div>
</div>