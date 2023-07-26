<x-simple-card buttonCol="7" labelCol="5" extClass="mt-3" headerClass="bg-info text-white "> 
    <x-slot name="title"><h6 class="text-white">
        Thông tin khoản nợ
    </h6></x-slot>
    <x-slot name="button">
        @can('edit_noxaus')
        <?php 
            $editRoute = route('no-xau.edit',['noXau'=>$noXau]);
            if($noXau->daXuLy()) {
                $ketThucRoute = route('no-xau.ket-thuc',[
                    'noXau'=>$noXau,
                    'trangThai'=>'phuc-hoi'
                ]);
                $ketThucLabel = "Phục hồi";
                $ketThucIcon = 'undo';
            } else {                

                $ketThucRoute = route('no-xau.ket-thuc',[
                    'noXau'=>$noXau,
                    'trangThai'=>'xu-ly'
                ]);
                $ketThucLabel = "Kết thúc";
                $ketThucIcon = 'check';

            }
            
        ?>
            <x-link-cap-nhat :route="$editRoute" label="Cập nhật" />
            <x-base-link :route="$ketThucRoute" :label="$ketThucLabel" colorClass='dark' :icon="$ketThucIcon"/>
        @endif
    </x-slot>
    <div class="table-responsive p-0">
        <table class="table align-items-center mb-0 table-borderless table-detail">
            <tbody>
                <tr>
                    <th>Ngày bắt đầu</th>
                    <td>{{formatNgayDMY($noXau->ngay_bat_dau)}}</td>                    
                </tr>
                <tr>
                    <th>Ngày kết thúc</th>
                    <td>{{($noXau->ngay_ket_thuc)?$noXau->ngay_ket_thuc:"Chưa kết thúc"}}</td>                    
                </tr>
                <tr>
                    <th>Số tiền nợ</th>
                    <td>{{thuGonSoLe($noXau->tong_so_tien)}}đ</td> 
                </tr>
                <tr>
                    <th>Trạng thái</th>
                    <td>{!!$noXau->labelTrangThai()!!}</td>                   
                   
                </tr>
                <tr>
                    <th>Tổng số tiền đã trừ</th>
                    <td>{{thuGonSoLe($noXau->tien_da_tru)}}đ</td>                    
                </tr>
                <tr>
                    <th>Số tiền còn lại</th>
                    <td>{{thuGonSoLe($noXau->tien_con_lai)}}đ</td>                    
                </tr>
            </tbody>
        </table>
    </div>
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
</x-simple-card>
