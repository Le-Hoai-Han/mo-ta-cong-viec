<x-dashboard-layout>
    <x-slot name="title">{{$profile->full_name}}</x-slot>
    <?php
    $user = auth()->user();

    $list = [
        '/' => 'Trang chủ',
        '#' => "Thông tin: " . $profile->full_name
    ];
    ?>

    <div class="main-div">
        <div class="row mt-4">
            <div class="card col-12 col-md-8  mb-lg-0 mb-4">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Profile nhân viên</h6>
                        </div>
                        <div class="col-6 text-end">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between  border-bottom mb-3">
                        <div>
                             <a class="text-primary" href="{{route('detail-profile.edit',$profile)}}" title="Cập nhật">
                                <span class="material-icons">
                                    mode_edit
                                </span>
                            </a>
                            @can('delete_users')
                            <?php $route = route('detail-profile.destroy', $profile->id); ?>
                            <a href="#" onclick='setDeleteUrl("{{$route}}")' class='text-danger'>
                                <span class="material-icons">
                                    delete
                                </span>
                            </a>
                            @endcan
                        </div>
                    </div>
                    @if(Session::has('error'))
                    <div class="alert alert-danger">{{Session::get('error')}}</div>
                    @endif
                    @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    <div class="jumbotron">
                        <div class="row col-xs-12 col-md-8">
                            <div class="col-xs-12 col-md-4 align-text-label">
                                <h6>{{ $profile->getLabel('full_name')}}</h6>
                            </div>
                            <div class="col-xs-12 col-md-8 align-text-value">
                                {{ $profile->full_name }}
                            </div>
                        </div>

                        <div class="row col-xs-12 col-md-8">
                            <div class="col-xs-12 col-md-4 align-text-label">
                                <h6>{{ $profile->getLabel('birthday')}}</h6>
                            </div>
                            <div class="col-xs-12 col-md-8 align-text-value">
                                {!! $profile->dateOfBirth() !!}
                            </div>
                        </div>
                        <div class="row col-xs-12 col-md-8">
                            <div class="col-xs-12 col-md-4 align-text-label">
                                <h6>{{ $profile->getLabel('gender')}}</h6>
                            </div>
                            <div class="col-xs-12 col-md-8 align-text-value">
                                {{ ($profile->gender)?"Nam":"Nữ" }}
                            </div>
                        </div>

                        <div class="row col-xs-12 col-md-8">
                            <div class="col-xs-12 col-md-4 align-text-label">
                                <h6>{{ $profile->getLabel('phone')}}</h6>
                            </div>
                            <div class="col-xs-12 col-md-8 align-text-value">
                                {!! ($profile->phone!="")?$profile->phone:"<i>Chưa cập nhật</i>" !!}
                            </div>
                        </div>
                        <div class="row col-xs-12 col-md-8">
                            <div class="col-xs-12 col-md-4 align-text-label">
                                <h6>{{ $profile->getLabel('address')}}</h6>
                            </div>
                            <div class="col-xs-12 col-md-8 align-text-value">
                                {!! ($profile->address!="")?$profile->address:"<i>Chưa cập nhật</i>" !!}
                            </div>
                        </div>
                        <div class="row col-xs-12 col-md-8">
                            <div class="col-xs-12 col-md-4 align-text-label">
                                <h6>{{ $profile->getLabel('district_id')}}</h6>
                            </div>
                            <div class="col-xs-12 col-md-8 align-text-value">
                                {!! ($profile->district_id!="")?$profile->district->name:"<i>Chưa cập nhật</i>" !!}
                            </div>
                        </div>
                        <div class="row col-xs-12 col-md-8">
                            <div class="col-xs-12 col-md-4 align-text-label">
                                <h6>{{ $profile->getLabel('province_id')}}</h6>
                            </div>
                            <div class="col-xs-12 col-md-8 align-text-value">
                                {!! ($profile->province_id!="")?$profile->province->name:"<i>Chưa cập nhật</i>" !!}
                            </div>
                        </div>

                        <div class="row col-xs-12 col-md-8">
                            <div class="col-xs-12 col-md-4 align-text-label">
                                <h6>{{ $profile->getLabel('position')}}</h6>
                            </div>
                            <div class="col-xs-12 col-md-8 align-text-value">
                                {!! ($profile->position!="")?$profile->position:"<i>Chưa cập nhật</i>" !!}
                            </div>
                        </div>
                        @if ($profile->user->hasRole('Employee'))
                        <div class="row col-xs-12 col-md-8">
                            <div class="col-xs-12 col-md-4 align-text-label">
                                <h6>{{ $profile->getLabel('department_id')}}</h6>
                            </div>
                            <div class="col-xs-12 col-md-8 align-text-value">
                                {!! ($profile->department_id!="")?$profile->department->name:"<i>Chưa cập nhật</i>" !!}
                            </div>
                        </div>
                        @else
                        <div class="row col-xs-12 col-md-8">
                            <div class="col-xs-12 col-md-4 align-text-label">
                                <h6>{{ $profile->getLabel('workplace')}}</h6>
                            </div>
                            <div class="col-xs-12 col-md-8 align-text-value">
                                {!! ($profile->workplace!="")?$profile->workplace:"<i>Chưa cập nhật</i>" !!}
                            </div>
                        </div>
                        @endif


    <x-slot name="title">{{$profile->full_name}}</x-slot>

    <?php
    $user = auth()->user();
    // if($user->hasRole('trainer')) {
    //     $checkRequest = false;
    // } else {
    //     $checkRequest = true;
    // }
    // @endphp 

    $list = [
        '/' => 'Trang chủ',
        '#' => "Thông tin: " . $profile->full_name
    ];
    ?>

    <div class="main-div">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Profile</h6>
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
                            <div class="d-flex justify-content-between  border-bottom mb-3">


                                <div>

                                    <a class="text-primary" href="{{route('detail-profile.edit',$profile)}}" title="Cập nhật">
                                        <span class="material-icons">
                                            mode_edit
                                        </span>
                                    </a>
                                    @can('delete_users')
                                    <?php $route = route('detail-profile.destroy', $profile->id); ?>
                                    <a href="#" onclick='setDeleteUrl("{{$route}}")' class='text-danger'>
                                        <span class="material-icons">
                                            delete
                                        </span>
                                    </a>
                                    @endcan


                                </div>
                            </div>

                            @if(Session::has('error'))
                            <div class="alert alert-danger">{{Session::get('error')}}</div>
                            @endif
                            @if(Session::has('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif
                            <div class="jumbotron">
                                <div class="row col-xs-12 col-md-8">
                                    <div class="col-xs-12 col-md-4 align-text-label">
                                        <h6>{{ $profile->getLabel('full_name')}}</h6>
                                    </div>
                                    <div class="col-xs-12 col-md-8 align-text-value">
                                        {{ $profile->full_name }}
                                    </div>
                                </div>

                                <div class="row col-xs-12 col-md-8">
                                    <div class="col-xs-12 col-md-4 align-text-label">
                                        <h6>{{ $profile->getLabel('birthday')}}</h6>
                                    </div>
                                    <div class="col-xs-12 col-md-8 align-text-value">
                                        {!! $profile->dateOfBirth() !!}
                                    </div>
                                </div>
                                <div class="row col-xs-12 col-md-8">
                                    <div class="col-xs-12 col-md-4 align-text-label">
                                        <h6>{{ $profile->getLabel('gender')}}</h6>
                                    </div>
                                    <div class="col-xs-12 col-md-8 align-text-value">
                                        {{ ($profile->gender)?"Nam":"Nữ" }}
                                    </div>
                                </div>


                                <div class="row col-xs-12 col-md-8">
                                    <div class="col-xs-12 col-md-4 align-text-label">
                                        <h6>{{ $profile->getLabel('phone')}}</h6>
                                    </div>
                                    <div class="col-xs-12 col-md-8 align-text-value">
                                        {!! ($profile->phone!="")?$profile->phone:"<i>Chưa cập nhật</i>" !!}
                                    </div>
                                </div>
                                <div class="row col-xs-12 col-md-8">
                                    <div class="col-xs-12 col-md-4 align-text-label">
                                        <h6>{{ $profile->getLabel('address')}}</h6>
                                    </div>
                                    <div class="col-xs-12 col-md-8 align-text-value">
                                        {!! ($profile->address!="")?$profile->address:"<i>Chưa cập nhật</i>" !!}
                                    </div>
                                </div>
                                <div class="row col-xs-12 col-md-8">
                                    <div class="col-xs-12 col-md-4 align-text-label">
                                        <h6>{{ $profile->getLabel('district_id')}}</h6>
                                    </div>
                                    <div class="col-xs-12 col-md-8 align-text-value">
                                        {!! ($profile->district_id!="")?$profile->district->name:"<i>Chưa cập nhật</i>" !!}
                                    </div>
                                </div>
                                <div class="row col-xs-12 col-md-8">
                                    <div class="col-xs-12 col-md-4 align-text-label">
                                        <h6>{{ $profile->getLabel('province_id')}}</h6>
                                    </div>
                                    <div class="col-xs-12 col-md-8 align-text-value">
                                        {!! ($profile->province_id!="")?$profile->province->name:"<i>Chưa cập nhật</i>" !!}
                                    </div>
                                </div>

                                <div class="row col-xs-12 col-md-8">
                                    <div class="col-xs-12 col-md-4 align-text-label">
                                        <h6>{{ $profile->getLabel('position')}}</h6>
                                    </div>
                                    <div class="col-xs-12 col-md-8 align-text-value">
                                        {!! ($profile->position!="")?$profile->position:"<i>Chưa cập nhật</i>" !!}
                                    </div>
                                </div>
                                @if ($profile->user->hasRole('Employee'))
                                <div class="row col-xs-12 col-md-8">
                                    <div class="col-xs-12 col-md-4 align-text-label">
                                        <h6>{{ $profile->getLabel('department_id')}}</h6>
                                    </div>
                                    <div class="col-xs-12 col-md-8 align-text-value">
                                        {!! ($profile->department_id!="")?$profile->department->name:"<i>Chưa cập nhật</i>" !!}
                                    </div>
                                </div>
                                @else
                                <div class="row col-xs-12 col-md-8">
                                    <div class="col-xs-12 col-md-4 align-text-label">
                                        <h6>{{ $profile->getLabel('workplace')}}</h6>
                                    </div>
                                    <div class="col-xs-12 col-md-8 align-text-value">
                                        {!! ($profile->workplace!="")?$profile->workplace:"<i>Chưa cập nhật</i>" !!}
                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



</x-dashboard-layout>
