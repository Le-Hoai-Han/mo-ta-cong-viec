<x-simple-card extClass="mt-3 " headerClass="bg-info text-white">
    <x-slot name="title">
    <h6 class="text-white">Sản phẩm thuộc đơn hàng</h6>
    </x-slot>
    @if(auth()->user()->can('edit_orders'))
    <x-slot name="button">
        <!-- <a href="#" 
                class="btn btn-warning btn-md align-middle">
                Thêm
            </a> -->
            <a href="{{route('capNhatSanPham',$donHang->id)}}" 
                class="btn btn-primary btn-md align-middle">Tính lại
            </a>
    </x-slot>
    
    @endif
<div class="table-responsive">
<table class="table table-bordered">
        <thead class="text-center">
            <tr>
                <th>#</th>
                <th>Tên <br>sản phẩm</th>
                <th>Giá sản phẩm <br> Giá bán</th>
                <th>SL</th>
                <th>Giá bán<br> chưa VAT</th>
                <th>VAT (TL VAT %)</th>
                <th>Chiết khấu (TL CK %)</th>
                <th>Chi phí <br>phát sinh</th>
                <th>Số tiền tính thưởng</th>
                <th>Tiền thưởng/(TL thưởng %)</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1?>
            @foreach($donHang->sanPhams as $sanPham)
            <tr>
                <th><?php echo  $i++ ?></th>
                <th>{{$sanPham->danhMucSanPham->ten_san_pham}}</th>
                <th>{{thuGonSoLe($sanPham->gia_san_pham)}} <br>{{thuGonSoLe($sanPham->gia_ban)}}</th>
                <th>{{($sanPham->so_luong)}}</th>
                <th>{{thuGonSoLe($sanPham->gia_ban_khong_vat)}}</th>
                <th>{{thuGonSoLe($sanPham->thue_vat)}} ({{thuGonSoLe($sanPham->ti_le_vat)}}%)</th>
                <th>{{thuGonSoLe($sanPham->chiet_khau)}} ({{thuGonSoLe($sanPham->ti_le_chiet_khau)}}%)</th>
                <th>{{thuGonSoLe($sanPham->chi_phi_phat_sinh)}}</th>
                <th>{{thuGonSoLe($sanPham->so_tien_tinh_thuong)}} </th>
                <th>{{thuGonSoLe($sanPham->so_tien_thuong)}} ({{thuGonSoLe($sanPham->ti_le_thuong)}}%)</th>
                <th>

                    @if(auth()->user()->can('edit_orders'))
                    <a href="{{route('sanphamthuocdonhang.edit',$sanPham)}}" class=""><span class="material-icons md-18 text-primary">
                        edit
                    </span></a>
                    @endif
                
            
            </th>
            </tr>
            @endforeach
       
                
        </tbody>
    </table>
</div>

</x-simple-card>