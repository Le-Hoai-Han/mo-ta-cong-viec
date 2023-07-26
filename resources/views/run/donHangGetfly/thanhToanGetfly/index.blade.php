<x-simple-card extClass="mt-3 " headerClass="bg-info text-white">
    <x-slot name="title">
        <h6 class="text-white">Thanh toán thuộc đơn hàng</h6>
    </x-slot>
    {{-- @if(auth()->user()->can('edit_orders'))
    <x-slot name="button">
            <a href="{{route('don-hang.thanh-toan.create',[
                                    'don_hang'=>$donHang
                                ])}}" 
                class="btn btn-warning btn-md align-middle">
                Thêm
            </a>
    </x-slot>
    @endif --}}
    <div class="table-responsive">
        <table class="table table-borderless " id="table-chi-tieu">
            <thead class="table-dark">
                <tr>
                    <th class="col-7" style="overflow-x:auto;text-align:center">Ngày</th>
                    <th class="col-2">Số tiền (VNĐ)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
               
                @forelse($donHang as $thanhToan)
                    <tr class="align-middle">
                        <td style="border:none;text-align:center">{{formatNgayDMY($thanhToan['pay_date'])}}</td>
                        <td style="border:none;text-align:right">{{thuGonSoLe($thanhToan['amount'])}}</td>
                       
                </tr>
                @empty 
                <tr>
                    <th colspan="2">Chưa có thông tin thanh toán</th>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @push('scripts')
    <script defer>
        window.addEventListener('load',()=>{
            let deleteButtonList = document.querySelectorAll('.delete-thanh-toan');
            if(deleteButtonList) {
                deleteButtonList.forEach(button=>{
                    button.addEventListener('click',(e)=>{
                        e.preventDefault();
                        if(confirm('Xóa thông tin thanh toán này?')) {
                            $.ajax({
                                url: button.getAttribute('delete-att'),
                                type: "DELETE",
                                data:{
                                    _token:"{{csrf_token()}}"
                                },
                                success:function(data) {
                                    location.reload();
                                }
                            })
                        }
                    })
                    
                });
            }
        });
    </script>
    @endpush
</x-simple-card>