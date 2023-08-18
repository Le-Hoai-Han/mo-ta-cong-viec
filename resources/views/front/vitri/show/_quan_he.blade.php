<div class="quan-he">
    <p style="text-align: left" class="so-do-to-chuc_tieu_de"><b>6. Quan hệ công việc</b></p>
        <table>
        <thead>
            <tr>
                <th>Bên trong công ty</th>
                <th>Bên ngoài công ty</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>
                        <ul class="list-quan-he">
                            @foreach($viTri->quanHe->where('loai',0) as $quanHe)
                                <li>{{$quanHe->noi_dung}}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul class="list-quan-he">
                            @foreach($viTri->quanHe->where('loai',1) as $quanHe)
                                <li>{{$quanHe->noi_dung}}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
        </tbody>
        </table>
</div>