@extends('admin.layouts.master')
@section('title','homeadmin')
@section('mainad-content')
<div class="page-wrapper">
    <!-- Page Content-->
    <div class="page-content">
        <div class="container-xxl">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-4">
                    <div class="row">
                        <div class="col-md-12 col-lg-6 col-xl-12">
                            <div class="card">
                                <div class="card-body border-dashed-bottom pb-3">
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-auto">
                                            <div class="d-flex justify-content-center align-items-center thumb-xl border border-secondary rounded-circle">
                                                <i class="icofont-money-bag h1 align-self-center mb-0 text-secondary"></i>
                                            </div> 
                                            <h5 class="mt-2 mb-0 fs-14">Tổng doanh thu</h5>
                                        </div><!--end col-->
                                        <!--end col-->
                                    </div><!--end row-->
                                </div><!--end card-body-->
                                <div class="card-body"> 
                                    <div class="row d-flex justify-content-center ">
                                        <div class="col-12 col-md-6">
                                            <h2 class="fs-22 mt-0 mb-1 fw-bold">{{$total}}đ</h2>
                                            <p class="mb-0 text-truncate text-muted"><span class="text-success"><i class="mdi mdi-trending-up"></i>8.5%</span> New Sessions Today</p>                                           
                                        </div><!--end col-->
                                    </div><!--end row-->  
                                </div><!--end card-body--> 
                            </div><!--end card-->
                        </div><!--end col-->
                    </div> <!--end row--> 
                </div> <!--end col--> 
                <div class="col-md-12 col-lg-12 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">                      
                                    <h4 class="card-title">Trung bình hàng tháng Thu nhập</h4>                      
                                </div><!--end col-->
                            </div>  <!--end row-->                                  
                        </div><!--end card-header-->
                        <div class="card-body pt-0">
                           <div class="row">
                                <div class="col-md-6 col-lg-3"> 
                                    <div class="card shadow-none border mb-3 mb-lg-0">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col text-center">                                                                        
                                                    <span class="fs-18 fw-semibold">{{$totaltoday}}đ</span>      
                                                    <h6 class="text-uppercase text-muted mt-2 m-0">Doanh thu hôm nay</h6>                
                                                </div><!--end col-->
                                            </div> <!-- end row -->
                                        </div><!--end card-body-->
                                    </div> <!--end card-body-->                     
                                </div><!--end col-->
                                <div class="col-md-6 col-lg-3"> 
                                    <div class="card shadow-none border mb-3 mb-lg-0">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col text-center">                                                                        
                                                    <span class="fs-18 fw-semibold">{{$count}}</span>      
                                                    <h6 class="text-uppercase text-muted mt-2 m-0">Số lượng hàng bán ra</h6>                
                                                </div><!--end col-->
                                            </div> <!-- end row -->
                                        </div><!--end card-body-->
                                    </div> <!--end card-body-->                     
                                </div><!--end col-->
                                
                                <div class="col-md-6 col-lg-3"> 
                                    <div class="card shadow-none border mb-3 mb-lg-0">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col text-center">                                                                        
                                                    <span class="fs-18 fw-semibold">{{$categoryCount}}</span>      
                                                    <h6 class="text-uppercase text-muted mt-2 m-0">Số lượng mặt hàng</h6>                
                                                </div><!--end col-->
                                            </div> <!-- end row -->
                                        </div><!--end card-body-->
                                    </div> <!--end card-->                     
                                </div><!--end col-->  
                                <div class="col-md-6 col-lg-3"> 
                                    <div class="card shadow-none border mb-3 mb-lg-0">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col text-center">                                                                        
                                                    <span class="fs-18 fw-semibold">{{$usercount}}</span>      
                                                    <h6 class="text-uppercase text-muted mt-2 m-0">Khách hàng</h6>                
                                                </div><!--end col-->
                                            </div> <!-- end row -->
                                        </div><!--end card-body-->
                                    </div> <!--end card-body-->                     
                                </div><!--end col-->                              
                            </div><!--end row-->
                        </div><!--end card-body--> 
                    </div><!--end card-->                             
                </div> <!--end col-->           
            </div><!--end row-->
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">                      
                                    <h4 class="card-title">Sản phẩm sắp hết</h4>                      
                                </div><!--end col--><!--end col-->
                            </div>  <!--end row-->                                  
                        </div><!--end card-header-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>image</th>  
                                            <th>tên</th>
                                            <th>price</th>
                                            <th>sale_price</th>
                                            <th>số lượng</th>
                                            <th>danh mục</th>
                                        </tr><!--end tr-->
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                <img src="{{asset('storage/images')}}/{{$item->image}}" alt="" width="50px">
                                            </td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->price}}</td>
                                            <td>{{$item->sale_price}}</td>
                                            <td>{{$item->discount}}</td>
                                            <td>{{$item->category->name}}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <span>chưa có dữ liệu</span>
                                        </tr>
                                        @endforelse
                                        </tbody>
                                </table> <!--end table-->                                               
                            </div><!--end /div-->
                        </div><!--end card-body--> 
                    </div><!--end card--> 
                </div> <!--end col-->
                
                <div class="col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">                      
                                    <h4 class="card-title">Đơn hàng</h4>                      
                                </div>
                            </div>                               
                        </div><!--end card-header-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">mã đơn</th>
                                            <th class="border-top-0">Tổng tiền</th>
                                            <th class="border-top-0">ngày tạo</th>
                                            <th class="border-top-0">trạng thái</th>
                                        </tr><!--end tr-->
                                    </thead>
                                    <tbody>
                                        @forelse ($order as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->total_money}}</td>
                                            <td>{{$item->created_at}}</td>
                                            <td><a href="{{Route('order.confirm',$item)}}" class="btn btn-success">xem</a></td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <span>chưa có dữ liệu</span>
                                        </tr>
                                        @endforelse
                                        </tbody>
                                </table> <!--end table-->                                               
                            </div><!--end /div-->
                        </div><!--end card-body--> 
                    </div>
                </div> <!--end col-->                                
            </div><!--end row-->
            
        </div>
        <!--end footer-->
    </div>
    <!-- end page content -->
</div>
@endsection