
<x-simple-card extClass="mt-3" headerClass="bg-gradient-primary text-white ">
    <x-slot name="title">
        <h5 class="text-white mb-0"><h6 class="text-white mb-3">Mức thưởng</h6>
    </x-slot>
    <div >
    <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Dòng sản phẩm</th>  
                    <th>Tiền thưởng<br>cơ bản</th> 
                    <th>Tiền thưởng<br>vượt mức</th>  
                    <th>Số lượng<br>vượt mức</th> 
                
                </tr>
            </thead>
            <tbody>
                @forelse($dsMucThuong as $index => $mucThuong)
                <tr>
                    <td>{{$index +1}}</td>
                    <td>{!!$mucThuong->linkView()!!}</td>  
                    <td>{{thuGonSoLe($mucThuong->tien_thuong_co_ban)}}</td> 
                    <td>{{thuGonSoLe($mucThuong->tien_thuong_vuot_muc)}}</td>  
                    <td>{{$mucThuong->so_luong_gioi_han}}</td> 
                
                </tr>
                @empty 
                <tr>
                    <td colspan="5">Không có mức thưởng nào</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        

    </div>
</x-simple-card>