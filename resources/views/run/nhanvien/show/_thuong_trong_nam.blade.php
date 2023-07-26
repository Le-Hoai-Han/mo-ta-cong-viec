<x-simple-card extClass="mt-3" headerClass="bg-dark text-white ">
    <x-slot name="title"><h5 class="text-white mb-3">Thưởng trong năm</h5></x-slot>
        <x-slot name="button">
            
        </x-slot>

        <table class="table table-borderless" id="thuong-nhan-vien-table">
            <thead>
                <tr >
                    <th style="width:50px">STT
                    </th>
                  
                    <th style="width:150px">Thời gian áp dụng
                    </th>
                    <th>Ngân sách thưởng (VNĐ)
                    </th>
                    <th>Thực lãnh (VNĐ)
                    </th>                                                                
                    <th style="width:100px">Hành động
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($dsThuongTrongNam as $index=>$thuong)
                <tr>
                    <th class='text-center'>{{$index+1}}</th>
                    <td class='text-center'>{{$thuong->thangNam->thang}}/{{$thuong->thangNam->nam}}</td>
                    <td class='text-right'>{{thuGonSoLe($thuong->ngan_sach_thuong)}}</td>
                    <td class='text-right'>{{thuGonSoLe($thuong->tong_tien_thuong_dat_duoc)}}</td>
                    <td class='text-center'>
                        <?php 
                        if($nhanVien->laKyThuat()) {
                            $viewRoute = route('thuong-ky-thuat.show',['thuongNhanVien'=>$thuong]);
                        } else {
                            $viewRoute = route('thuong-nhan-vien.show',['thuong_nhan_vien'=>$thuong]);
                        }
                        
                        
                        ?>
                        <a href="{{$viewRoute}}" class="text-primary">
                            <i class="fas fa-money-check" aria-hidden="true"></i>  
                        <a>
                    </td>

                </tr>
                @empty 
                <tr><td colspan='5'>Chưa có thông tin thưởng cho nhân viên</td></tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" style="text-align:right">Total:</th>
                    <td class='text-right'>{{thuGonSoLe($dsThuongTrongNam->sum('ngan_sach_thuong'))}}</td>
                    <td class='text-right'>{{thuGonSoLe($dsThuongTrongNam->sum('tong_tien_thuong_dat_duoc'))}}</td>
                </tr>
            </tfoot>
        </table>

    </x-simple-card>
@push('styles')
<style>
.text-center{
    text-align:center;
}
.text-right{
    text-align:right;
}
</style>
@endpush 

