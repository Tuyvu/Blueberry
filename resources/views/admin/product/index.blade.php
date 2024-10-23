@extends('admin.layouts.master')
@section('title','homeadmin')
@section('mainad-content')
<div class="page-wrapper">

    <!-- Page Content-->
    <div class="page-content">
        <div class="container-xxl">
            <div class="ibox-content">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button>	
                        <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="row">
                    <div class="col-sm-9 m-b-xs">
                        <a href="{{route('product.create')}}" class="btn btn-success">Thêm mới danh mục</a>
                        <a href="{{route('product.restore')}}" class="btn btn-success"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
            
                            <th>#</th>
                            <th>tên</th>
                            <th>giá</th>
                            <th>giá KM</th>
                            <th>số lượng</th>
                            <th>danh mục</th>
                            <th>ảnh</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($products as $index =>$item)
                        <tr>
                            <td>{{$products->firstItem() + $index }}</td>
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
                            
                            <td><a href="{{Route('product.edit',$item)}}" class="btn btn-success">sửa</a></td>
                            <td>
                                <form action="{{Route('product.destroy',$item)}}" method="POST" onsubmit="return confirmDelete();">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <span>chưa có dữ liệu</span>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {!! $products->links('pagination::bootstrap-5') !!}
            </div>
            <script>
                function confirmDelete() {
                    return confirm("Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?");
                }
            </script>
        </div><!-- container -->

        <!--Start Rightbar-->
        <!--Start Rightbar/offcanvas-->

        <!--end footer-->
    </div>
    <!-- end page content -->
</div>
@endsection
