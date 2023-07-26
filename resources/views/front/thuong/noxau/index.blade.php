<?php 
$current = "Danh sách nợ xấu";
use App\Models\NhanVien;
?>
<x-dashboard-layout :current="$current">
    <div class="main-div">
        <div class="row " >
            <div class="col-xs-12">
                <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                  <h6 class="mb-0">Danh sách nợ xấu</h6>
                                </div>
                                <div class="col-6 text-end">
                                    
                                    @if(auth()->user()->can('add_noxaus'))
                                        <a href="{{route('no-xau.create')}}" class="btn btn-primary btn-md mb-0">
                                            <i class="fas fa-plus" aria-hidden="true"></i> Thêm mới
                                        </a>                              
                                    @endif
                                </div>
                              </div>
                        </div>
                        <div class="card-body over-flow-y">
                            @include('front.thuong.noxau._grid_no_xau')
                            
                        </div>
                    </div>
                </div>
        </div>
    </div>
    
</x-dashboard-layout>
