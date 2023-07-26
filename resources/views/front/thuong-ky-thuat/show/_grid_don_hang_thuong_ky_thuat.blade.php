<x-simple-card extClass="mt-3" headerClass="bg-primary text-white "> 
    <x-slot name="title"><h6 class="text-white">Các đơn hàng được thưởng lắp đặt/đào tạo</h6></x-slot>
    <x-slot name="button">
       
    </x-slot>
    <table class="table table-bordered" id="table-chi-tieu ">

        <thead class="bg-secondary text-white align-middle table-dark ">
            <tr>   
                <th class="col-1">STT</th>                              
                <th class="col-2">Mã ĐH</th>
                <th class="col-2" style="text-align:center">Ngày nghiệm thu </th>  
                <th class="col-5">Mô tả</th>
                <th class="col-2" style="text-align:right">Số tiền</th>
                
            </tr>
        </thead>
        <tbody>
            @forelse($dsThuongKyThuatDonHang as $index=>$thuongKyThuatDonHang)
                <tr>        
                    <td>{{$index+1}}</td>                         
                    <td> <strong>{!!$thuongKyThuatDonHang->donHang->showLink()!!}</strong></td>
                    <td style="text-align:center;" class="text-success">{{formatNgayDMY($thuongKyThuatDonHang->donHang->ngay_nghiem_thu)}} </td> 
                    <td>{!!$thuongKyThuatDonHang->mo_ta!!}</td>
                    <td style="text-align:right">{{thuGonSoLe($thuongKyThuatDonHang->so_tien_thuong)}} đ</td>
                    
                                                  
                </tr>
            @empty 
                <tr>
                    <td colspan="5">Chưa có đơn hàng nào được thưởng trong tháng này</td>
                </tr>
            @endforelse 
            <tr class="bg-secondary text-white"> 
                <th colspan="4" style="text-align:center">Tổng cộng</th>
                <th style="text-align:right">{{thuGonSoLe($dsThuongKyThuatDonHang->sum('so_tien_thuong'))}} đ</th>
            </tr>
        </tbody>
        
    </table>
</x-simple-card>