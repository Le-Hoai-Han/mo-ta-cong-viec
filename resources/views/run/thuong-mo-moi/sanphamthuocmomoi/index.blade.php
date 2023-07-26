<x-simple-card extClass="mt-3 " headerClass="bg-info text-white">
    <x-slot name="title">
    <h6 class="text-white">Sản phẩm thuộc mở mới</h6>
    </x-slot>
    @if(auth()->user()->can('edit_orders'))

    
    @endif
<div class="table-responsive">
<table class="table table-bordered">
        <thead class="text-center">
            <tr>
                <th>#</th>
                <th>Tên <br>sản phẩm</th>
                <th>Giá sản phẩm</th>
                <th>SL</th>
                <th>Tiền thưởng/(TL thưởng %)</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1?>
            @foreach($donHang->TMMDonHangKhachHang->sanPhamThuocMoMoi as $sanPhamTMM)
            <tr>
                <th><?php echo  $i++?></th>
                <th>{{$sanPhamTMM->danhMucSanPham->ten_san_pham}}</th>
                <th>{{thuGonSoLe($sanPhamTMM->gia_san_pham)}}</th>
                <th>{{($sanPhamTMM->so_luong)}}</th>
                <th>{{thuGonSoLe(($sanPhamTMM->so_luong*$sanPhamTMM->gia_san_pham)*($sanPhamTMM->ti_le_thuong)/100)}} ({{thuGonSoLe($sanPhamTMM->ti_le_thuong)}}%)</th>
                <th>
                    @if(auth()->user()->can('edit_orders'))
                    <a href="{{route('san-pham-thuoc-mo-moi.edit',$sanPhamTMM)}}" class=""><span class="material-icons md-18 text-primary">
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