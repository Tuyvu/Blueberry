@extends('admin.layouts.master')
@section('title','homeadmin')
@section('mainad-content')
<div class="page-wrapper">

    <!-- Page Content-->
    <div class="page-content">
        <div class="container-xxl"> 
            <div class="row">
                <div class="col-lg-8">
                    
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">                      
                                    <h4 class="card-title">Đơn hàng {{$order->id}}</h4>                     
                                </div><!--end col-->
                                <div class="col-auto">                      
                                    <a href="{{route('order.finishOrder',$order->id)}}" class="btn btn-primary">Xác nhận đơn</a>                
                                </div><!--end col-->
                            </div>  <!--end row-->                                  
                        </div><!--end card-header-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                      <tr>
                                        <th>#</th>
                                        <th>image</th>
                                        <th>Tên</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Tổng tiền</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                <img src="{{asset('storage/images')}}/{{$item->product->image}}" alt="" width="150px">
                                            </td>
                                            <td>{{$item->product->name}}</td>
                                            <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
                                            <td>{{$item->total_money/$item->price}}</td>
                                            <td>{{ number_format($order->total_money, 0, ',', '.') }} đ</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <span>chưa có dữ liệu</span>
                                        </tr>
                                        @endforelse
                                        
                                    </tbody>
                                </table>
                                
                            </div>
                        </div><!--card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">                      
                                    <h4 class="card-title">Chi tiết thanh toán</h4>                      
                                </div><!--end col-->
                                <div class="col-auto">                      
                                    <span class="badge rounded text-warning bg-warning-subtle fs-12 p-1">Payment pending</span>                  
                                </div><!--end col-->
                            </div>  <!--end row-->                                  
                        </div><!--end card-header-->
                        <div class="card-body pt-0">
                            <div>
                                @if ($order->shiptype == '1')
                                    <div class="d-flex justify-content-between">
                                        <p class="text-body fw-semibold">Tiền hàng :</p>
                                        <p class="text-body-emphasis fw-semibold">{{ number_format($order->total_money-15000, 0, ',', '.') }}đ</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="text-body fw-semibold">Phí vận chuyển :</p>
                                        <p class="text-danger fw-semibold">15.000đ</p>
                                    </div>
                                    @else
                                    <div class="d-flex justify-content-between">
                                        <p class="text-body fw-semibold">Tiền hàng :</p>
                                        <p class="text-body-emphasis fw-semibold">{{ number_format($order->total_money-30000, 0, ',', '.') }}đ</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="text-body fw-semibold">Phí vận chuyển :</p>
                                        <p class="text-danger fw-semibold">30.000đ</p>
                                    </div>
                                        @endif
                                        <div class="d-flex justify-content-between">
                                            <p class="text-body fw-semibold">Tổng thanh toán :</p>
                                            <p class="text-body-emphasis fw-semibold">{{ number_format($order->total_money, 0, ',', '.') }} đ</p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            @if ($order->pay == '1')
                                            <p class="text-body fw-semibold">Thanh toán khi nhận hàng</p>
                                            @else
                                            <p class="text-body fw-semibold">Thanh toán vnPay</p>
                                            @endif
                                            
                                          </div>
                            </div>
                            <hr class="hr-dashed">
                            <div class="d-flex justify-content-between">
                                @if ($order->pay == '1')
                                <h4 class="mb-0">Tổng thu   : {{ number_format($order->total_money, 0, ',', '.') }} đ</h4>

                                        @else
                                <h4 class="mb-0">Tổng thu  : 0đ</h4>
                                        @endif</p>
                        

                              </div>
                        </div><!--card-body-->
                    </div><!--end card-->
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">                      
                                    <h4 class="card-title">Chi tết hóa đơn</h4>                      
                                </div><!--end col-->
                            </div>  <!--end row-->                                  
                        </div><!--end card-header-->
                        <div class="card-body pt-0">
                            <div>
                                <div class="d-flex justify-content-between mb-2">
                                    <p class="text-body fw-semibold"><i class="iconoir-people-tag text-secondary fs-20 align-middle me-1"></i>Họ tên :</p>
                                    <p class="text-body-emphasis fw-semibold">{{$order->fullname}}</p>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <p class="text-body fw-semibold"><i class="iconoir-mail text-secondary fs-20 align-middle me-1"></i>Email :</p>
                                    <p class="text-body-emphasis fw-semibold">{{$order->email}}</p>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <p class="text-body fw-semibold"><i class="iconoir-mail text-secondary fs-20 align-middle me-1"></i>SDT :</p>
                                    <p class="text-body-emphasis fw-semibold">{{$order->phone}}</p>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <p class="text-body fw-semibold"><i class="iconoir-dollar-circle text-secondary fs-20 align-middle me-1"></i>Tổng thanh toán :</p>
                                    <p class="text-body-emphasis fw-semibold"><span class="text-primary">{{ number_format($order->total_money, 0, ',', '.') }}đ</p>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <p class="text-body fw-semibold"><i class="iconoir-calendar text-secondary fs-20 align-middle me-1"></i>Ngày đặt :</p>
                                    <p class="text-body-emphasis fw-semibold">{{ $order->created_at->format('d/m/Y')}}</p>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <p class="text-body fw-semibold"><i class="iconoir-calendar text-secondary fs-20 align-middle me-1"></i>Ngày nhận dự kiến :</p>
                                    <p class="text-body-emphasis fw-semibold">
                                        @if ($order->shiptype == '1')
                                        {{ $order->created_at->addDay()->format('d/m/Y') }}
                                        @else
                                            {{ $order->created_at->addDays(2)->format('d/m/Y') }}
                                        @endif</p>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <p class="text-body fw-semibold"><i class="iconoir-delivery-truck text-secondary fs-20 align-middle me-1"></i>Giao hàng :</p>
                                    @if ($order->shiptype == '1')
                                    <p class="text-body-emphasis fw-semibold">Giao hành nhanh</p>
                                        @else
                                        <p class="text-body-emphasis fw-semibold">Giao hàng thường</p>
                                        @endif</p>
                                    
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="text-body fw-semibold"><i class="iconoir-map-pin text-secondary fs-20 align-middle me-1"></i>Dịa chỉ :</p>
                                    <p class="text-body-emphasis fw-semibold">{{$order->address}}</p>
                                    </p>
                                </div>                                        
                            </div>
                        </div><!--card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->
            </div> <!-- end row -->                                       
        </div><!-- container -->
        
        <!--Start Rightbar-->
        <!--Start Rightbar/offcanvas-->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="Appearance" aria-labelledby="AppearanceLabel">
            <div class="offcanvas-header border-bottom justify-content-between">
              <h5 class="m-0 font-14" id="AppearanceLabel">Appearance</h5>
              <button type="button" class="btn-close text-reset p-0 m-0 align-self-center" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">  
                <h6>Account Settings</h6>
                <div class="p-2 text-start mt-3">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="settings-switch1">
                        <label class="form-check-label" for="settings-switch1">Auto updates</label>
                    </div><!--end form-switch-->
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="settings-switch2" checked="">
                        <label class="form-check-label" for="settings-switch2">Location Permission</label>
                    </div><!--end form-switch-->
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="settings-switch3">
                        <label class="form-check-label" for="settings-switch3">Show offline Contacts</label>
                    </div><!--end form-switch-->
                </div><!--end /div-->
                <h6>General Settings</h6>
                <div class="p-2 text-start mt-3">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="settings-switch4">
                        <label class="form-check-label" for="settings-switch4">Show me Online</label>
                    </div><!--end form-switch-->
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="settings-switch5" checked="">
                        <label class="form-check-label" for="settings-switch5">Status visible to all</label>
                    </div><!--end form-switch-->
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="settings-switch6">
                        <label class="form-check-label" for="settings-switch6">Notifications Popup</label>
                    </div><!--end form-switch-->
                </div><!--end /div-->               
            </div><!--end offcanvas-body-->
        </div>
        <!--end Rightbar/offcanvas-->
        <!--end Rightbar-->
        <!--Start Footer-->
        
        <footer class="footer text-center text-sm-start d-print-none">
            <div class="container-xxl">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-0 rounded-bottom-0">
                            <div class="card-body">
                                <p class="text-muted mb-0">
                                    ©
                                    <script> document.write(new Date().getFullYear()) </script>2024
                                    Rizz
                                    <span class="text-muted d-none d-sm-inline-block float-end">
                                        Crafted with
                                        <i class="iconoir-heart text-danger"></i>
                                        by Mannatthemes</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        
        <!--end footer-->
    </div>
    <!-- end page content -->
</div>

@endsection
