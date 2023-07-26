<table class="table-bordered table ">
    <thead>
      <tr>
        <th class="col-3">Tên sản phẩm</th>
        <th class="col-2">Giá sản phẩm</th>
        <th class="col-1">Số lượng</th>
        <th class="col-1">VAT(%)</th>
        <th class="col-1">Chiết khấu(%)</th>
        <th class="col-1">Chiết khấu(VNĐ)</th>
        <th class="col-2">Tổng cộng</th>
        <th class="col-1"></th>
      </tr>
    </thead>
    <tbody>
      <tr class="row-sp-1">
        <td id="selected-cell-1">
            <select id="san_pham_1" name="SanPham[1][id_san_pham]" class="form-control">
                
            </select>
        </td>
        <td class="text-end"><input type="number" name="SanPham[1][gia_sp]" value="{{old('SanPham[1][gia_sp]',0)}}" class="form-control" /></td>
        <td class="text-center"><input type="number" name="SanPham[1][so_luong]" value="{{old('SanPham[1][so_luong]',0)}}" class="form-control" /></td>
        <td class="text-end"><input type="number" name="SanPham[1][ti_le_vat]" value="{{old('SanPham[1][ti_le_vat]',0)}}" class="form-control" /></td>
        <td class="text-end"><input type="number" name="SanPham[1][ti_le_chiet_khau]" value="{{old('SanPham[1][ti_le_chiet_khau]',0)}}" class="form-control" /></td>
        <td class="text-end"><input type="number" name="SanPham[1][chiet_khau]" value="{{old('"SanPham[1][chiet_khau]',0)}}" class="form-control" /></td>
        <td class="text-end"><input type="number" name="SanPham[1][gia_ban]" value="{{old('SanPham[1][gia_ban]',0)}}" class="form-control" /></td>
        <td><a class="delete-row" ><span class='material-icons text-danger'>delete</span></a></td>
    </tr>

      
      
    </tbody>
    <tfooter>
        <tr>
            <td colspan="8">
              <button type="button" id="add_row_product" class="btn btn-secondary btn-md mb-0">
                <i class="fas fa-plus" aria-hidden="true"></i> Thêm sản phẩm</a>  
              </button>
            </td>
        </tr>
    </tfooter>
  </table>