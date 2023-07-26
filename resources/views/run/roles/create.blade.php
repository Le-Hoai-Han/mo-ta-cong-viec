<x-dashboard-layout>
    <x-slot name="title">Thêm quyền mới</x-slot>
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
                    <div class="cart-header mt-4">
                       
                    </div>
                    <div class="card-body">
                    @if(Session::has('status'))
                            <p class="alert alert-success">{{ Session::get('status') }}</p>
                        @endif
                        <div class="col-12 col-md-6">
                            <form action="{{route('roles.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">{{ $role->getLabel('name')}}</label>
                                    <input type="text" name="name" class="form-control" id="name" aria-describedby="name">
                                    @error('name')
                                        <span class="text-danger">{{ $message}}</span>
                                    @enderror
                                    {{-- <small id="name" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                </div>
                        
                                <div class="form-group">
                                    <label for="label">{{ $role->getLabel('label')}}</label>
                                    <textarea class="form-control"  name="label" id="label" rows="3"></textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message}}</span>
                                    @enderror
                                </div>
                            
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </form>
                        </div>
                        @push('bottom_scripts')
                
                         @endpush
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   
</x-app-layout>

