<x-dashboard-layout>
    <x-slot name="title">Danh sách quyền</x-slot>
    <?php 
    $user = auth()->user();

    $list = [
        '/'=>'Trang chủ',
        '#'=>"Danh sách nhóm quyền"
    ];
    ?>
    <div class="main-div">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="cart-header mt-4">
                        <div class="d-flex justify-content-between  border-bottom mb-3" >
                            <div>
                                
                                <a class="text-primary" href="{{route('roles.create')}}" title="Cập nhật">
                                    <span class="material-icons">
                                        enhanced_encryption
                                    </span>
                                </a>  
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(Session::has('success'))
                            <p class="alert alert-success">{{ Session::get('success') }}</p>           
                        @endif
                        @if(Session::has('error'))
                            <p class="alert alert-danger">{{ Session::get('error') }}</p>           
                        @endif
                    
                                
                            
                        @forelse ($roles as $role)
                            {{-- <form action ="/roles/{{$role->id}}" method="POST" > --}}
                            <?php //dd($role->permissions());?>
                            @if($role->name != 'admin')
                                {{-- @include('shared._permissions1', [
                                            'title' => $role->name .' Permissions',
                                            'options' => ['disabled'] ])
                            @else --}}
                                @include('run.shared._permissions1', [
                                            'title' => $role->name .' Permissions',
                                            'model' => $role ])
                    
                            @endif
                            @empty
                                <p>No Roles defined, please run <code>php artisan db:seed</code> to seed some dummy data.</p>
                            @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
  
      
       
 
                </x-dashboard-layout>