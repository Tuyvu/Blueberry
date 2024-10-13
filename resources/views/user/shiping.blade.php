@extends('user.master')
@section('title', 'Home')
@section('main-content')
@include('user.header')
<section class="section-checkout padding-tb-50">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 m-b-xs">
                <a href="{{route('user.shiping')}}" class="bb-btn-2">Tất cả đơn hàng</a>
                <a href="{{route('user.shipingWait')}}" class="bb-btn-2">Chờ xác nhận</a>
                <a href="{{route('user.shipingship')}}" class="bb-btn-2">Đang vận chuyển</a>
                <a href="{{route('user.Delivered')}}" class="bb-btn-2">Đã giao hàng</a>
                <a href="{{route('user.Received')}}" class="bb-btn-2">Đã nhận</a>
            </div>
        </div>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                      <tr>
                        <th>Image</th>
                        <th>Tên</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $item)
                            @foreach($item->orderDetails as $detail)
                            <tr>
                                <td>
                                    <img src="{{asset('storage/images')}}/{{$detail->product->image}}" alt="" width="150px">
                                </td>
                                <td>{{$detail->product->name}}</td>
                                <td>{{number_format($detail->price, 0, ',', '.')}}đ</td>
                                <td>{{$detail->total_money / $detail->price}}</td>
                                @if ($item->pay==1)    
                                <td>{{number_format($item->total_money, 0, ',', '.')}}đ</td>
                                @else
                                <td>0</td>
                                    
                                @endif
                                <td><a href="{{Route('user.detailshiping',$item)}}" class="btn btn-success">xem</a></td>
                            </tr>
                            @endforeach
                        @empty
                        <tr>
                            <td colspan="6">Chưa có dữ liệu</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div><!--card-body-->
    </div>
</section>

@include('user.footer')
@include('user.slider')
@endsection
