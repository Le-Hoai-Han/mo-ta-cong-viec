<?php $current = "Danh sách khách hàng "; ?>

<x-dashboard-layout :current="$current">
    <x-slot name="title">Khách hàng</x-slot>
    <div class="main-div">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Danh sách khách hàng</h6>
                            </div>
                            
                            <div class="col-6 d-flex align-items-center search-index-khach-hang">
                                <div id="order-table_filter">
                                    <form action="{{route('khach-hang.index')}}">
                                        <label for="">Tìm kiếm
                                            <input name="key" type="search" class="form-control form-control-sm" value="{{old('key',$key)}}" placeholder="" aria-controls="order-table">
                                        </label>

                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body over-flow-y">
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
                            <table class="table table-sm" id="customer-table" style="text-align:center">
                                <thead>
                                    <tr >
                                        <th style="text-align: center">Id</th>
                                        <th>Mã khách hàng</th>
                                        <th >Tên khách hàng</th>
                                        <th>Email</th>
                                        <th>Điện thoại</th>  
                                        <th>Người phụ trách</th>  
                                        <th>Hành động</th>  
                                        {{-- <th class="px-4 py-2">Updated At</th> --}}
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($khachHang as $item)
                                    {{-- <?php dd($item) ?> --}}
                                    <tr>
                                        <td>{{$item['id']}}</td>
                                        <td>{{$item['ma_khach_hang']}}</td>
                                        <td style="text-align: left">{{$item['ten_khach_hang']}}</td>
                                        <td>{{($item['email'] != null)?$item['email']:'(Chưa câp nhật)'}}</td>
                                        <td>{{$item['dien_thoai']}}</td>
                                        <td>{{$item['nguoi_phu_trach']}}</td>
                                        <td><a href="{{route('khach-hang.show',$item['id'])}}"><span class="material-icons" style="color: rgb(13, 119, 59)">visibility</span></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            
                            </table>
                            <div class="paginate">
                                <ul class="list-paginate">
                                    @if($pageSearch >= 7 && $pageSelecte >=5)
                                    <li>
                                        <a style="" href="{{route('khach-hang.index','?page='.$pagePrevious.'&key='.$key)}}"><</a>
                                    </li>
                                    <li>
                                        <a style="" href="{{route('khach-hang.index','?page=1')}}">1</a>
                                    </li>
                                    <li>
                                        <a style="" >...</a>
                                    </li>
                                    @endif
                                    @foreach($arrPage as $page)
                                    <li>
                                        <a style="{{($page['page'] == $pageSelecte)?'background-color:#5e72e4!important;color:white':'' }}" href="{{route('khach-hang.index','?page='.$page['page'].'&key='.$key)}}">{{$page['page']}}</a>
                                    </li>
                                    @endforeach

                                    @if($pageSelecte+2 < $pageSearch)
                                    <li>
                                        <a style="" >...</a>
                                    </li>
                                        
                                    <li>
                                        <a style="{{($page['page'] == $pageSelecte)?'background-color:#5e72e4!important;color:white':'' }}" href="{{route('khach-hang.index','?page='.$pageSearch.'&key='.$key)}}">{{$pageSearch}}</a>
                                    </li>
                                    <li>
                                        <a style="" href="{{route('khach-hang.index','?page='.$pageNext.'&key='.$key)}}" >></a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 

</x-dashboard-layout>