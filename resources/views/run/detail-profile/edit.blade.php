<x-dashboard-layout>
    
    <x-slot name="title">{{$profile->full_name}}</x-slot>

    <?php 
  
    $list = [
        '/'=>'Trang chủ',
        route('detail-profile.show',$profile) => $profile->full_name,
        '#'=>"Cập nhật"
    ];
    ?>

<div class="main-div">
        <div class="row mt-4">
            <div class="card col-12 col-md-6  mb-lg-0 mb-4">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Cập nhật profile nhân viên</h6>
                        </div>
                        <div class="col-6 text-end">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                @if(Session::has('status'))
    
    <div class="main-div">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Cập nhật thông tin</h6>
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
                            @if(Session::has('status'))
    <p class="alert alert-success">{{ Session::get('status') }}</p>
@endif
<div class="col-12 col-md-12">
    <form action="{{route('detail-profile.update',$profile)}}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">{{ $profile->getLabel('full_name')}}</label>
            <input type="text" name="full_name" class="form-control" id="full_name" aria-describedby="full_name" value="{{ old("full_name",$profile->full_name)}}">
            @error('full_name')
                <span class="text-danger">{{ $message}}</span>
            @enderror
        </div>
      
        <div class="form-group">
            <label for="name">{{ $profile->getLabel('gender')}}</label>
            {{-- <input type="text" name="first_name" class="form-control" id="gender" aria-describedby="gender" value="{{ old("gender",$profile->gender)}}"> --}}
            <div class="switch-field mt-1">
                <input type="radio" id="gender-male" name="gender" value="1" {{ (old('gender',$profile->gender))  == 1 ?"checked":""}}/>
                <label for="gender-male">Nam</label>
                <input type="radio" id="gender-female" name="gender" value="0" {{ (old('gender',$profile->gender))  == 0 ?"checked":""}}/>
                <label for="gender-female">Nữ</label>
            </div>
            @error('gender')
                <span class="text-danger">{{ $message}}</span>
            @enderror
            {{-- <small id="name" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
        </div>
        <?php 
            $birthday = old("birthday",$profile->birthday);
            if($birthday!="") {
                $birthday = date('d-m-Y',strtotime($birthday));
                $birthday = str_replace('-','/',$birthday);
            }
          
            
        ?>
        <div class="form-group">
            <label for="name">{{ $profile->getLabel('birthday')}}</label>
            <input type="text" name="birthday" class="form-control" id="birthday" value="{{ $birthday }}" 
            {{-- patern="^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$"  --}}
            autocomplete="off">

            @error('birthday')
                <span class="text-danger">{{ $message}}</span>
            @enderror
            {{-- <small id="name" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
        </div>
        <div class="form-group">
            <label for="name">{{ $profile->getLabel('phone')}}</label>
            <input type="text" name="phone" class="form-control" id="phone" aria-describedby="phone" value="{{ old("phone",$profile->phone)}}">
            @error('phone')
                <span class="text-danger">{{ $message}}</span>
            @enderror
            {{-- <small id="name" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
        </div>
        <div class="form-group">
            <label for="name">{{ $profile->getLabel('address')}}</label>
            <input type="text" name="address" class="form-control" id="address" aria-describedby="address" value="{{ old("address",$profile->address)}}">
            @error('address')
                <span class="text-danger">{{ $message}}</span>
            @enderror
            {{-- <small id="name" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
        </div>
        <div class="form-group">
            <label for="name">{{ $profile->getLabel('province_id')}}</label>
            <select name="province_id" class="form-control" id="province_id" aria-describedby="province_id">
                <?php //dd($profile->province_id) ?>

                @if($profile->province_id != "")
                    <option value="{{ $profile->province_id}}" selected>{{$profile->province->name}}</option>
                @endif
                
                @foreach ($provinces as $province)
                    @if($province['id'] === $profile->province_id)
                        <option value="{{$province['id']}}" selected>{{$province['name']}}</option>                    
                    @else 
                        <option value="{{$province['id']}}">{{$province['name']}}</option>                    
                    @endif
                @endforeach
                
            </select>
            @error('province_id')
                <span class="text-danger">{{ $message}}</span>
            @enderror
            {{-- <small id="name" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
        </div>
        <div class="form-group">
            <label for="name">{{ $profile->getLabel('district_id')}}</label>
            <select type="text" name="district_id" class="form-control" id="district_id">
                @if($profile->district_id != "")
                    <option value={{ $profile->district_id}} selected>{{$profile->district->name}}</option>
                @endif
                @foreach ($districts as $district)
                    @if($district->id === $profile->district_id)
                        <option value="{{$district->id}}" selected>{{$district->name}}</option>                    
                    @else 
                        <option value="{{$district->id}}">{{$district->name}}</option>                    
                    @endif
                @endforeach
            </select>
            @error('district_id')
                <span class="text-danger">{{ $message}}</span>
            @enderror
            {{-- <small id="name" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
        </div>
        
        <div class="form-group">
            <label for="position">{{ $profile->getLabel('position')}}</label>
            <input type="text" name="position" class="form-control" id="position" aria-describedby="position" value="{{ old("position",$profile->position)}}">
            @error('position')
                <span class="text-danger">{{ $message}}</span>
            @enderror
            {{-- <small id="name" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
        </div>

        @if ($profile->user->hasRole('Employee'))
        <div class="form-group">
            <label for="department_id">{{ $profile->getLabel('department_id')}}</label>
            <select name="department_id" class="form-control" id="department_id" aria-describedby="department_id">
                <option value=""></option>
                @if($profile->department_id != "") 
                <option value="{{$profile->department_id}}" selected>{{$profile->department->name}}</option> 
                @endif
                @foreach ($departments as $department)
                    @if($department['id'] === $profile->department_id)
                        <option value="{{$department['id']}}" selected>{{$department['name']}}</option>                    
                    @else 
                        <option value="{{$department['id']}}">{{$department['name']}}</option>                    
                    @endif
                @endforeach
                
            </select>
            @error('department_id')
                <span class="text-danger">{{ $message}}</span>
            @enderror
            {{-- <small id="name" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
        </div>
        @else
            <div class="form-group">
            <label for="workplace">{{ $profile->getLabel('workplace')}}</label>
            <input type="text" name="workplace" class="form-control" id="workplace" aria-describedby="workplace" value="{{ old("workplace",$profile->workplace)}}">
            @error('workplace')
                <span class="text-danger">{{ $message}}</span>
            @enderror
            {{-- <small id="name" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
        </div>
        @endif
        <button type="submit" class="btn btn-primary">Cập nhật</button>
      </form>
    </div>
                </div>
            </div>
        </div>

    </div>
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   

   
    @push('styles')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/pikaday.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/selectize/selectize.bootstrap3.css')}}" />
    <style type="text/css">
      
        .switch-field {
            display: flex;
            margin-bottom: 0;
            overflow: hidden;
        }
        
        .switch-field input {
            position: absolute !important;
            clip: rect(0, 0, 0, 0);
            height: 1px;
            width: 1px;
            border: 0;
            overflow: hidden;
        }
        
        .switch-field label {
            background-color: #e4e4e4;
            color: rgba(0, 0, 0, 0.6);
            font-size: 14px;
            line-height: 1;
            text-align: center;
            padding: 8px 16px;
            margin-right: -1px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
            transition: all 0.1s ease-in-out;
        }
        
        .switch-field label:hover {
            cursor: pointer;
        }
        
        .switch-field input:checked + label {
            background-color:  #aa1419;
            color:white;
            box-shadow: none;
        }
        
        .switch-field label:first-of-type {
            border-radius: 4px 0 0 4px;
        }
        
        .switch-field label:last-of-type {
            border-radius: 0 4px 4px 0;
        }
        
        /* This is just for CodePen. */
        
        .form {
            max-width: 600px;
            font-family: "Lucida Grande", Tahoma, Verdana, sans-serif;
            font-weight: normal;
            line-height: 1.625;
            margin: 8px auto;
            padding: 16px;
        }
        
        h2 {
            font-size: 18px;
            margin-bottom: 8px;
        }
        </style>
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css"> --}}
    @endpush


    @push('scripts')        
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>

    <script type="text/javascript" src="{{asset('/js/pikaday/moment.min.js')}}"></script>
 
    <script>
        var picker = new Pikaday({
            field: document.getElementById("birthday"),
            format: 'D/M/YYYY',
            toString(date, format) {
                // you should do formatting based on the passed format,
                // but we will just return 'D/M/YYYY' for simplicity
                const day = date.getDate();
                const month = date.getMonth() + 1;
                const year = date.getFullYear();
                return `${day}/${month}/${year}`;
            },
            parse(dateString, format) {
                // dateString is the result of `toString` method
                const parts = dateString.split('/');
                const day = parseInt(parts[0], 10);
                const month = parseInt(parts[1], 10) - 1;
                const year = parseInt(parts[2], 10);
                return new Date(year, month, day);
            }
        });
  
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('/js/selectize/selectize.min.js')}}"></script>
    <script type="text/javascript">
            var xhr;
            var select_state, $select_state;
            var select_city, $select_city;

            // provinceControl.on("change",function(value) {
            //     console.log(value);
            //     // let test = selectize.getValue();
            //     // console.log(test);
            // });
            $select_state = $('#province_id').selectize({
                onChange: function(value) {
                    if (!value.length) return;
                    //select_city.disable();
                    select_city.clearOptions();
                    select_city.load(function(callback) {
                        xhr && xhr.abort();
                        xhr = $.ajax({
                            url: '{!! route('getDistrictData') !!}',
                            // datatype:'json',
                            data: {
                                    province: value,
                                    //q: query,
                                    // page_limit: 10,
                                    // "_token": "{{ csrf_token() }}",
                                },
                            success: function(results) {
                                select_city.enable();
                                console.log(results.length);
                                callback(JSON.parse(results));
                            },
                            error: function() {
                                callback();
                            }
                        })
                    });
                }
            });
            $select_city = $('#district_id').selectize({
                valueField: 'id',
                labelField: 'name',
                searchField: ['name']
            });

            select_city  = $select_city[0].selectize;
            select_city.setValue("{{$profile->district_id}}");
            select_state = $select_state[0].selectize;
            select_state.setValue("{{$profile->province_id}}");

            

    </script>
    @endpush
</x-dashboard-layout>