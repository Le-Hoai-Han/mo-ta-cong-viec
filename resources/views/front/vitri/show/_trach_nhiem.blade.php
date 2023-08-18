<div class="">
    <p style="text-align: left" class="so-do-to-chuc_tieu_de"><b>4. Các trách nhiệm và nhiệm vụ chính</b></p>
    <div class="trach-nhiem-nhiem-vu">
        <table>
        <thead>
            <tr>
                <th>Trách nhiệm và nhiệm vụ chính</th>
                <th>Kết quả đầu ra</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach($viTri->nhiemVu as $nhiemVu)
                <tr>
                    <td>
                        <p style="font-size: 18px"> <b>Trách nhiệm thứ {{$i++}}. {{$nhiemVu->ten_nhiem_vu}}</b></p>
                        <ul class="list-nhiem-vu">
                            @foreach($nhiemVu->moTaNhiemVu as $moTa)
                                <li>{{$moTa->chi_tiet}}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>

    
</div>