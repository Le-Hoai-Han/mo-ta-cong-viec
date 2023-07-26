<?php $current = "Danh sách users "; ?>
<x-dashboard-layout :current="$current">
    <x-slot name="title">Danh sách users</x-slot>

    <?php 
    $list = [
            '/'=>'Trang chủ',
            '#'=>'Danh sách users'
        ];
    ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-xl-4">Danh sách users</div>
                        <div class="col-12 col-xl-8 text-end">
                            {{-- @if(auth()->user()->can('add_orders')) --}}
                            <a href="{{route('users.create')}}" class="btn btn-primary btn-md mb-0"><i class="fas fa-plus" aria-hidden="true"></i> Thêm user</a>
                            {{-- @endif --}}
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

                    @if(Session::has('error'))
                        <div style="color:white" class="alert alert-danger">{{Session::get('error')}}</div>
                    @endif

                    <div class="row">
                        <div class="table-reponsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Họ và tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Avatar</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($listUsers as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->sdt }}</td>
                                            <td>{{$user->avatar}}</td>
                                            <td><a href="{{route('users.edit',$user)}}">edit</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-main-layout>