    <x-simple-card extClass="mt-3" headerClass="bg-gradient-success text-white ">
    <x-slot name="title"><h5 class="text-white mb-3">Thông tin nhân viên</h5></x-slot>
        <x-slot name="button">
            <?php 
                $route=route('nhanvien.index');
                $editRoute = route('nhanvien.edit',$nhanVien);
            ?>
            <x-link-quay-ve :route="$route" label="" />
            <x-link-cap-nhat :route="$editRoute" label="" />
        </x-slot>

        <table class="table table-borderless">
            <tbody>
                <tr>
                    <th>Họ tên</th>
                    <td>{{$nhanVien->ho_ten}} {!!$nhanVien->trang_thai_xoa_label!!}</td>                    
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{$nhanVien->user->email}}</td>                    
                </tr>
                <tr>
                    <th>Nhóm</th>
                    <td>{{($nhanVien->nhomNhanVien)?$nhanVien->nhomNhanVien->ten_nhom:"Chưa có nhóm"}}</td>                    
                </tr>
                <tr>
                    <th>Getfly ID</th>
                    <td>{{$nhanVien->getfly_id}}</td>                    
                </tr>
            </tbody>
        </table>
       
    </x-simple-card>     
    
    
@push('styles')
<style>
    .table.table-borderless tr:last-child th,
    .table.table-borderless tr:last-child td{
        border:none !important;
    }

    .table.table-detail th{
        /* text-align: right; */
        width:40%;
    }
</style>
@endpush 