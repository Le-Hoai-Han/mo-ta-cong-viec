<div class="table-responsive" id="div-chi-tieu">
    <table class="table table-borderless">
        <thead>
            <th style="text-align:right">Tên chỉ tiêu</th>
            <th style="text-align:center">Mục tiêu</th>            
        </thead>
        <tbody id="tbody-chi-tieu">
            <?php /*
            @foreach($dsChiTieu as $chiTieu)
            <tr>
                <td class="col-12 col-md-4 col-xl-3" style="border:none;vertical-align:middle;text-align:right"><label>{{$chiTieu->ten_chi_tieu}}</label></td>
                <td class="col-12 col-md-8 col-xl-9" style="border:none">
                    <?php 
                    $chiTieuName = "chi_tieu[".$chiTieu->id."]";
                    ?>
                    <input type="text" name="{{$chiTieuName}}" value="{{old($chiTieuName,$chiTieu->muc_tieu_mac_dinh)}}" class="form-control"/>
                </td>
            </tr>
            @endforeach
          */  ?>
        </tbody>
    </table>
</div>