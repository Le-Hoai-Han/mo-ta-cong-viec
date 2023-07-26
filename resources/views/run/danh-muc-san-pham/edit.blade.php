<x-masterlayout>
@if ($errors->any())
  <div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    <p style="font-size:12px">{{ $error }}</p>
    @endforeach
  </div>
  @endif
<form method="post" action="{{route('danhmucSP.update',$data)}}">
    @csrf
    @method('PUT')
    <div class="card-header">
      <div class="form-group">
        <label for="exampleInputEmail1">Id</label>
        <input type="text" value="{{$data->id}}" disabled name="" class="form-control" id="" placeholder="">
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Mã sản phẩm</label>
        <input value="{{$data->ma_san_pham}}" disabled type="text" name="ma_san_pham" class="form-control" id="" placeholder="">
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Tên sản phẩm</label>
        <input value="{{$data->ten_san_pham}}" disabled type="text" name="ten_san_pham" class="form-control" id="" placeholder="">
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Mô tả</label>
        <input value="{{$data->mo_ta}}" type="text" name="mo_ta" class="form-control" id="" placeholder="Nhập mô tả">
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Tỉ lệ thưởng(%  )</label>
        <input value="{{$data->ti_le_thuong}}" type="text" name="ti_le_thuong" class="form-control" id="" placeholder="Nhập tỉ lệ thưởng">
      </div>

      <div class="form-group">
        <label for="dong_san_pham">Dòng sản phẩm</label>
        <input value="{{$data->ti_le_thuong}}" type="text" name="dong_san_pham" class="form-control" id="" placeholder="Nhập tỉ lệ thưởng">
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Cập Nhật</button>
      
    </div>
  </form>

</x-masterlayout>