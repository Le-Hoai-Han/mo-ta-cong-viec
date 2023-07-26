<div class="panel panel-default border-gray-500 border-solid border-2 my-8">
    <div class="bg-gray-400 " role="tab" id="{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}">
        <h4 class="panel-title font-bold px-5 py-5">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#dd-{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}"  >
                {{ $title }} {!! isset($user) ? '<span class="text-danger">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!}
            </a>
        </h4>
        
    </div>
    <div id="dd-{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}" >
            <div class="container">
                <?php $i=0;?>
                <div class='row'>
                @foreach($permissions as $perm)
                    <?php
                    
                    
                        $per_found = null;

                        if( isset($role) ) {
                            $per_found = $role->hasPermissionTo($perm->name);
                        }

                        if( isset($user)) {
                            $per_found = $user->hasDirectPermission($perm->name);
                        }
                    ?>

                    <div class="col">
                        <div class="checkbox">
                            <label class="{{ Str::contains($perm->name, 'delete') ? 'text-red-700' : '' }}">
                                
                            <input type="checkbox" 
                                name="permissions[]" 
                                value="{{$perm->name}}" 
                                @if($per_found) 
                                    checked
                                @endif
                                {{-- {{ (isset($options) ? $options : []) }}  --}}
                                id=""> {{ $perm->name}}
                                {{-- {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : []) !!} {{ $perm->name }} --}}
                            </label>
                        </div>
                    </div>
                    <?php
                    $i++;
                    if($i==4) {
                        $i=0;
                        echo "</div><div class='row'>";
                    } 
                    ?>
                @endforeach
                </div>
           
            </div>
    </div>
</div>