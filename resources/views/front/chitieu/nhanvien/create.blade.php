<?php 
$current = "Thêm nhân viên vào chỉ tiêu";
$list = [    
    url('/chi-tieu')=>'Danh sách hạng mục',
    route('chi-tieu.show',[
        'chi_tieu'=>$chiTieu
    ])=>$chiTieu->ten_chi_tieu
        
]
?>

<x-dashboard-layout :current="$current" :list="$list">
    <div  class="main-div">
        <div class="row" >
                <div class="col-12 col-md-5">
                    <form name="them_chi_tieu" method="POST" id="frm_them_chi_tieu" action="{{route('chi-tieu.nhan-vien.store',$chiTieu)}}">
                        @csrf
                        <div class="card col-12">
                            <div class="card-header pb-0 p-3">

                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Thêm chỉ tiêu</h6>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="submit" class="btn btn-primary btn-md mb-0">Lưu thông tin</button>
                                
                                </div>
                                </div>
                            </div>
                            <div class="card-body">
                            @if(Session::has('error'))
                                <div class="alert alert-danger">{{Session::get('error')}}</div>
                            @endif
                            @if(Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif 
                                <p class="text-uppercase text-sm">Thông tin chỉ tiêu</p>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ten_chi_tieu" class="form-control-label">Tên chỉ tiêu</label>
                                            <input readonly class="form-control" type="text" value="{{old('ten_chi_tieu',$chiTieu->ten_chi_tieu)}}" name="ten_chi_tieu" id="ten_chi_tieu"  onfocus="focused(this)" onfocusout="defocused(this)">
                                            @error('ten_chi_tieu')
                                                <span class="help text-danger"> {{ $message}}</span>
                                            @enderror
                                        </div>
                                        
                                    </div> 
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label for="loai_chi_tieu" class="form-control-label">Loại chỉ tiêu</label>
                                            <input readonly class="form-control" type="text" value="{{old('loai_chi_tieu',$chiTieu->loai_chi_tieu)}}" name="loai_chi_tieu" id="loai_chi_tieu"  onfocus="focused(this)" onfocusout="defocused(this)">
                                            @error('loai_chi_tieu')
                                                <span class="help text-danger"> {{ $message}}</span>
                                            @enderror
                                        </div>
                                    </div>                                    
                                </div>
                                <hr class="horizontal dark">
                                <p class="text-uppercase text-sm">Đặt chỉ tiêu cá nhân</p>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="thang_su_dung" class="form-control-label">Thời gian áp dụng</label>
                                            <select  name="thang_su_dung[]" id="thang_su_dung" aria-label="Tháng" placeholder="Thời gian áp dụng" multiple="multiple" class="form-control multiple-optgroups">
                                                @php 
                                                    $nam = $dsThang[0]->nam;
                                                @endphp
                                                <optgroup label="Năm {{$nam}}">  
                                                @foreach ($dsThang as $thang):
                                                    

                                                    @if($nam!=$thang->nam)
                                                        </optgroup>
                                                        <optgroup label="{{$thang->nam}}">  
                                                        @php
                                                            $nam = $thang->nam; 
                                                        @endphp                            
                                                    @endif
                                                    
                                                        <option value="{{$thang->id}}">Tháng {{$thang->thang}}/{{$nam}}</option>
                                                    
                                                    
                                                @endforeach
                                                </optgroup>
                                                ?>
                                            </select>
                                            @error('thang_su_dung')
                                                <span class="help text-danger"> {{ $message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Chọn nhân viên</label>
                                            <select name="nhan_vien[]" id="nhan_vien" aria-label="Người nhận chỉ tiêu" placeholder="Người nhận chỉ tiêu" multiple="multiple" class="form-control">
                                                @foreach ($dsNhanVien as $nhanVien)
                                                    <option  value="{{$nhanVien->id}}"> {{$nhanVien->ho_ten}}</option>
                                                @endforeach
                                            </select>
                                            @error('nhan_vien')
                                                <span class="help text-danger"> {{ $message}}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="muc_tieu" class="form-control-label">Số lượng yêu cầu</label>
                                            <input class="form-control" type="text" value="{{old('muc_tieu','')}}" name="muc_tieu" id="muc_tieu" placeholder="Nhập số lượng" onfocus="focused(this)" onfocusout="defocused(this)">
                                            @error('muc_tieu')
                                                <span class="help text-danger"> {{ $message}}</span>
                                            @enderror
                                        </div>

                                        
                                    </div>                                    
                                </div>
                            </div>
                        </div>

                        
                    </form>
                    
                </div>
                <div class="col-12 col-md-7">
                    <div class="row" >           
                        <div class="card col-12 mb-lg-0 mb-4">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-6 d-flex align-items-center">
                                        <h6 class="mb-0">Danh sách  viên thuộc chỉ tiêu</h6>
                                    </div>
                                    <div class="col-6 text-end">

                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                        @include('front.chitieu._list_chi_tieu',[])
                                </div>
                            </div>
                        </div>
                </div>
                </div>
                
        </div>

    </div>

    @push('styles')
        <link rel="stylesheet" href="{{asset('css/slimselect.min.css')}}">
        <style>
        .ss-main .ss-multi-selected,
        .ss-main .ss-single-selected{
            min-height:38px;
            padding:0.2rem 0.3rem;
        }
        .ss-main{
            padding:0;
        }
        </style>
    @endpush

    @push('scripts')
        <script src="{{asset('js/slimselect.min.js')}}"></script>
        <script type="text/javascript">
            new SlimSelect({
                select: '#nhan_vien'
            })
            new SlimSelect({
                select: '#thang_su_dung'
            })
           
        </script>
    @endpush

    @push('styles')
    <link rel="stylesheet" href="{{ asset('datatable/datatables.min.css') }} ">
        <style>
            /* .table.dataTable.no-footer{
                border-bottom:unset;
            } */

        </style>
    @endpush

    @push('scripts')
    <script src="{{ asset('datatable/datatables.min.js') }}"></script>

    <script type="text/javascript" async>

        let tableNhanVien;
        $(function() {
            tableNhanVien = $('#nhan-vien-table').DataTable({
                // headers: {
                //         'X-CSRF-Token': '{{ csrf_token() }}',
                //     },
                processing: true,
                serverSide: true,
                ajax: {
                    url:'{!! route('chi-tieu.nhan-vien.getData',['chiTieu'=>$chiTieu]) !!}',
                    method:'post',
                    data: function(d){
                        d.thang = $("#sch_nv_thang_ap_dung").val();
                        d.ho_ten = $("#sch_nv_ho_ten").val();
                        d._token = '{{ csrf_token() }}';
                    }
                },
                oLanguage: {
                    sSearch: "Tra cứu:",
                    sProcessing: "Đang tải dữ liệu",
                    oPaginate:{
                        sNext: ">",
                        sPrevious:"<"
                    },
                    sEmptyTable:"Chưa có nhân viên thuộc hạng mục này",
                    sInfo:"Hiển thị từ _START_ to _END_ trong tổng số  _TOTAL_",
                    sInfoEmpty:"Không tìm thấy kết quả nào",
                    sInfoFiltered:"(lọc từ _MAX_ bản ghi)",
                    sZeroRecords: "Không tìm thấy kết quả theo yêu cầu",
                    sLengthMenu:"Hiển thị _MENU_ kết quả"
                },
                columns: [
                    { data: 'id', name: 'id',searchable:false },
                    { data: 'ten_nhan_vien', name: 'ten_nhan_vien' },
                    { data: 'thang_ap_dung', name: 'thang_ap_dung',className: 'text-center' },                    
                    // { data: 'muc_tieu', name: 'muc_tieu',className: 'text-end'  },
                    { data: 'ket_qua_dat_duoc', name: 'ket_qua_dat_duoc',className: 'text-end pe-4' },
                    { data: 'ti_le_dat_duoc', name: 'ti_le_dat_duoc',className: 'text-end pe-4' },
                    // { data: 'mo_ta', name: 'mo_ta' },                   
                    //{ data: 'actions', name: 'actions', searchable: false, orderable:false},
                ]
            });

            tableNhanVien.columns().eq(0).each(function(colIdx) {
                $('input', tableNhanVien.column(colIdx).header()).on('keydown', function(ev) {
                    if (ev.keyCode == 13) { //only on enter keypress (code 13)
                        tableNhanVien.draw();
                        ev.preventDefault();
                    }
                });            

                $('input', tableNhanVien.column(colIdx).header()).on('click', function(e) {
                    e.stopPropagation();
                });
       
            });

            
        });
        
        </script>
    
    @endpush
</x-dashboard-layout>