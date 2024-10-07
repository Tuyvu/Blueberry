<head>
    <link rel="shortcut icon" href="{{asset('admin-asset')}}/assets/images/favicon.ico">
    <link rel="stylesheet" href="{{asset('admin-asset')}}/assets/libs/jsvectormap/css/jsvectormap.min.css">
     <link href="{{asset('admin-asset')}}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
     <link href="{{asset('admin-asset')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
     <link href="{{asset('admin-asset')}}/assets/css/app.min.css" rel="stylesheet" type="text/css" />
</head>

<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">                      
                <h4 class="card-title">Theo dõi đơn hàng</h4>                      
            </div><!--end col-->
        </div>  <!--end row-->                                  
    </div><!--end card-header-->
    <div class="card-body pt-0">
        <div class="position-relative m-4">
            <div class="progress" role="progressbar" aria-label="Progress" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height: 1px;">
              <div class="progress-bar" style="width: 50%"></div>
            </div>
            @switch($orders->status)
                @case(0)
                    <div class="position-absolute top-0 start-0 translate-middle bg-primary text-white rounded-pill thumb-md"><i class="iconoir-home"></i></div>
                    <div class="position-absolute top-0 start-50 translate-middle bg-primary-subtle text-primary rounded-pill thumb-md"><i class="iconoir-delivery-truck"></i></div>
                    <div class="position-absolute top-0 start-100 translate-middle bg-light text-dark rounded-pill thumb-md"><i class="iconoir-map-pin"></i></div>
                    @break
                @case(1)
                    <div class="position-absolute top-0 start-0 translate-middle bg-primary-subtle text-primary rounded-pill thumb-md"><i class="iconoir-home"></i></div>
                    <div class="position-absolute top-0 start-50 translate-middle bg-primary text-white rounded-pill thumb-md"><i class="iconoir-delivery-truck"></i></div>
                    <div class="position-absolute top-0 start-100 translate-middle bg-light text-dark rounded-pill thumb-md"><i class="iconoir-map-pin"></i></div>
                    @break
                @case(2)
                    <div class="position-absolute top-0 start-0 translate-middle bg-primary-subtle text-primary rounded-pill thumb-md"><i class="iconoir-home"></i></div>
                    <div class="position-absolute top-0 start-50 translate-middle bg-primary-subtle text-primary rounded-pill thumb-md"><i class="iconoir-delivery-truck"></i></div>
                    <div class="position-absolute top-0 start-100 translate-middle bg-primary text-white rounded-pill thumb-md"><i class="iconoir-map-pin"></i></div>
                    @break
                @case(3)
                    <div class="position-absolute top-0 start-0 translate-middle bg-primary-subtle text-primary rounded-pill thumb-md"><i class="iconoir-home"></i></div>
                    <div class="position-absolute top-0 start-50 translate-middle bg-primary-subtle text-primary rounded-pill thumb-md"><i class="iconoir-delivery-truck"></i></div>
                    <div class="position-absolute top-0 start-100 translate-middle bg-primary text-white rounded-pill thumb-md"><i class="iconoir-map-pin"></i></div>
                    @break
                @default
                    
            @endswitch
        </div>
        <div class="row row-cols-3">
            <div class="col text-start">
                <h6 class="mb-1">Người bán đang chuẩn bị hàng</h6>
                <p class="mb-0 text-muted fs-12 fw-medium">{{ $orders->created_at->format('d/m/Y')}}</p>
            </div> <!-- end col -->
            <div class="col text-center">
                <h6 class="mb-1">Đang giao hàng</h6>
                <p class="mb-0 text-muted fs-12 fw-medium">
                    @if ($orders->shiptype == '1')
                    {{ $orders->created_at->addDay()->format('d/m/Y') }}
                    @else
                        {{ $orders->created_at->addDays(2)->format('d/m/Y') }}
                    @endif</p></p>
            </div> <!-- end col -->
            <div class="col text-end">
                <h6 class="mb-1">giao hàng thành công</h6>
                <p class="mb-0 text-muted fs-12 fw-medium">
                    @if ($orders->shiptype == '1')
                    {{ $orders->created_at->addDay()->format('d/m/Y') }}
                    @else
                        {{ $orders->created_at->addDays(2)->format('d/m/Y') }}
                    @endif</p></p>
            </div> <!-- end col -->
        </div> <!-- end row -->                                    
        <div class="bg-primary-subtle p-2 border-dashed border-primary rounded mt-3">
            <span class="text-primary fw-semibold">ghi chú :</span><span class="text-primary fw-normal"> Được kiểm tra hàng trước khi nhận!</span>
        </div>
    </div><!--card-body-->
</div>

<script src="{{asset('admin-asset')}}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('admin-asset')}}/assets/libs/simplebar/simplebar.min.js"></script>
<script src="{{asset('admin-asset')}}/assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="{{asset('admin-asset')}}/assets/data/stock-prices.js"></script>
<script src="{{asset('admin-asset')}}/assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
<script src="{{asset('admin-asset')}}/assets/libs/jsvectormap/maps/world.js"></script>
<script src="{{asset('admin-asset')}}/assets/js/pages/index.init.js"></script>
<script src="{{asset('admin-asset')}}/assets/js/app.js"></script>