@extends('admin.layouts.master')
@section('title','homeadmin')
@section('mainad-content')
<div class="page-wrapper">
  <div class="page-content">
    <div class="container-xxl">
<!-- Page Content-->
        <div class="ibox-content">
      @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
              <strong>{{ $message }}</strong>
      </div>
      @endif
      <div class="row">
          <div class="col-sm-9 m-b-xs">
              <a href="{{route('product.index')}}" class="btn btn-success">back</a>
          </div>
      </div>
      <div class="table-responsive">
          <table class="table table-striped">
            <table class="table table-striped">
                <thead>
                <tr>
    
                    <th>#</th>
                    <th>tên</th>
                    <th>price</th>
                    <th>sale_price</th>
                    <th>số lượng</th>
                    <th>danh mục</th>
                    <th>image</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($products as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
                    @if ($item->sale_price)
                        <td>{{ number_format($item->sale_price, 0, ',', '.') }}đ</td>
                    @else
                        <td></td>
                    @endif
                    <td>{{$item->discount}}</td>
                    <td>{{$item->category->name}}</td>
                    <td>
                        <img src="{{asset('storage/images')}}/{{$item->image}}" alt="" width="150px">
                    </td>
                    
                    <td><a href="{{Route('product.restore_id',$item->id)}}" class="btn btn-success">khôi phục</a></td>
                    <td><a href="{{Route('product.foredelete',$item->id)}}" onclick="return confirmDelete();" class="btn btn-danger">xóa</a></td>
                </tr>
                @empty
                <tr>
                    <span>chưa có dữ liệu</span>
                </tr>
                @endforelse
                </tbody>
            </table>
          </table>
      </div>
      <script>
        function confirmDelete() {
            return confirm("Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?");
        }
    </script>
  </div> 
        <!-- end page content -->
    </div>
</div>
    <!-- Page Content-->
     <!-- end page content -->
</div>
@endsection
