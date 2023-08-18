<div class="tham-quyen">
    <p style="text-align: left" class="so-do-to-chuc_tieu_de"><b>5. Thẩm quyền/Quyền hạn</b></p>
        <table>
        <thead>
            <tr>
                <th>Đề xuất</th>
                <th>Ra quyết định</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>
                        <ul class="list-tham-quyen">
                            @foreach($viTri->thamQuyen->where('loai',1) as $thamQuyen)
                                <li>{{$thamQuyen->noi_dung}}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul class="list-tham-quyen">
                            @foreach($viTri->thamQuyen->where('loai',2) as $thamQuyen)
                                <li>{{$thamQuyen->noi_dung}}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
        </tbody>
        </table>
</div>