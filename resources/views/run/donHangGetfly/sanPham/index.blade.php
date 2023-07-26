<x-simple-card extClass="mt-3 " headerClass="bg-info text-white">
    <x-slot name="title">
    <h6 class="text-white">Sản phẩm thuộc đơn hàng</h6>
    </x-slot>
    @if(auth()->user()->can('edit_orders'))
    {{-- <x-slot name="button">
        <a href="#" 
                class="btn btn-warning btn-md align-middle">
                Thêm
            </a>
    </x-slot> --}}
    @endif
<div class="table-responsive">
<table class="table table-bordered">
        <thead class="text-center">
            <tr>
                <th>#</th>
                <th>Tên <br>sản phẩm</th>
                <th>Giá <br>sản phẩm</th>
                <th>SL</th>
                <th>Giá bán</th>
                 <th>Chiết khấu</th>
                 <th>VAT(%)</th>
                 <th>VAT(VNĐ)</th>
                {{-- <th>Chi phí <br>phát sinh</th> --}}
                {{-- <th>Tỉ lệ<br> thưởng(%)</th>
                <th>Tiền thưởng</th> --}}
                {{-- <th></th> --}}
            </tr>
        </thead>
        <tbody>
            <?php $i=1?>
            @foreach($products as $sanPham)
            <tr>
                <th><?php echo  $i++ ?></th>
                <th>{{$sanPham['product_name']}}</th>
                <th>{{thuGonSoLe($sanPham['price'])}}</th>
                <th>{{($sanPham['quantity'])}}</th>
                <th>{{thuGonSoLe($sanPham['amount'])}}</th>
                 <th>{{number_format($sanPham['discount'])}}</th> 
                 <th>{{number_format($sanPham['vat'])}}</th> 
                 <th>{{number_format($sanPham['vat_amount'])}}</th> 
                {{-- <th>{{thuGonSoLe($sanPham->chi_phi_phat_sinh)}}</th>
                <th>{{thuGonSoLe($sanPham->ti_le_thuong)}}</th>
                <th>{{thuGonSoLe($sanPham->so_tien_thuong)}}</th> --}}
                {{-- <th> --}}

                    {{-- @if(auth()->user()->can('edit_orders'))
                <a href="{{route('sanphamthuocdonhang.edit',$sanPham)}}" class=""><span class="material-icons md-18 text-primary">
                        edit
                    </span></a>
                    @endif --}}
                
            
            {{-- </th> --}}
            </tr>
            @endforeach
       
                
        </tbody>
    </table>
</div>

</x-simple-card>