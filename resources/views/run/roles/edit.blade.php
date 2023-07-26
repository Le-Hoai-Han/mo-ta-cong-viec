<x-dashboard-layout>
    <x-slot name="title">Cập nhật {{$role->name}}</x-slot>
    <?php 
    $user = auth()->user();

    $list = [
        '/'=>'Trang chủ',
        route('roles.index')=>"Danh sách nhóm quyền",
        '#'=>'Cập nhật quyền'
    ];  
    ?>
    <div class="main-div">
        <div class="row">
            <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                               
                        </div>
                        <div class="card-body">
                              @if(Session::has('status'))
                                    <p class="alert alert-success">{{ Session::get('status') }}</p>
                                @endif
                                <div class="col-12 col-md-6">
                                    <form action="{{route('roles.update',$role)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="name">{{ $role->getLabel('name')}}</label>
                                            <input type="text" name="name" class="form-control" id="name" aria-describedby="name" value="{{ old('name',$role->name)}}">
                                            @error('name')
                                                <span class="text-danger">{{ $message}}</span>
                                            @enderror
                                            {{-- <small id="name" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                        </div>
                                
                                        <div class="form-group">
                                            <label for="label">{{ $role->getLabel('label')}}</label>
                                            <textarea class="form-control"  name="label" id="label" rows="3">{{ old('label',$role->label)}}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message}}</span>
                                            @enderror
                                        </div>
                                    
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    </form>
                                 </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

   
   
  
</x-dashboard-layout>

