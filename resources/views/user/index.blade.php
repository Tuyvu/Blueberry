@extends('user.master')
@section('title', 'Home')
@section('main-content')
@include('user.header')
<section class="section-hero margin-b-50">
    <div class="bb-social-follow">
        <ul class="inner-links">
            <li>
                <a href="https://www.facebook.com/">Fb</a>
            </li>
            <li>
                <a href="https://twitter.com/">TW</a>
            </li>
            <li>
                <a href="https://instagram.com/">In</a>
            </li>
            <li>
                <a href="https://linkedin.com/">Li</a>
            </li>
        </ul>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="hero-slider swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide slide-1">
                            <div class="row mb-minus-24">
                                <div class="col-lg-6 col-12 order-lg-1 order-2 mb-24">
                                    <div class="hero-contact">
                                        <p>Giảm giá 30%</p>
                                        <h1>Khám phá <span>Sức khỏe</span><br> & Trái cây</h1>
                    
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 order-lg-2 order-1 mb-24">
                                    <div class="hero-image">
                                        <img src="{{asset('assets')}}/img/hero/hero-1.png" alt="hero">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 300"
                                            class="animate-shape">
                                            <linearGradient id="shape_1" x1="100%" x2="0%" y1="100%" y2="0%">
                                            </linearGradient>
                                            <path d="">
                                                <animate repeatCount="indefinite" attributeName="d" dur="15s"
                                                    values="" />
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-2">
                            <div class="row mb-minus-24">
                                <div class="col-lg-6 col-12 order-lg-1 order-2 mb-24">
                                    <div class="hero-contact">
                                        <p>Giảm giá 20%</p>
                                        <h2>Khám phá <span>Ẩm thực</span><br> Đồ ăn nhanh</h2>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 order-lg-2 order-1 mb-24">
                                    <div class="hero-image">
                                        <img src="{{asset('assets')}}/img/hero/hero-2.png" alt="hero">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 300"
                                            class="animate-shape">
                                            <linearGradient id="shape_2" x1="80%" x2="0%" y1="80%" y2="0%">
                                            </linearGradient>
                                            <path d="">
                                                <animate repeatCount="indefinite" attributeName="d" dur="15s"
                                                    values="" />
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-3">
                            <div class="row mb-minus-24">
                                <div class="col-lg-6 col-12 order-lg-1 order-2 mb-24">
                                    <div class="hero-contact">
                                        <p>Giảm giá 30%</p>
                                        <h2>Khám phá <span>Organic</span><br> & Thực phẩm sạch</h2>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 order-lg-2 order-1 mb-24">
                                    <div class="hero-image">
                                        <img src="{{asset('assets')}}/img/hero/hero-3.png" alt="hero">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 300"
                                            class="animate-shape">
                                            <linearGradient id="shape_3" x1="80%" x2="0%" y1="80%" y2="0%">
                                            </linearGradient>
                                            <path d="">
                                                <animate repeatCount="indefinite" attributeName="d" dur="15s"
                                                    values="" />
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination swiper-pagination-white"></div>
                    <div class="swiper-buttons">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Category -->
<section class="section-category padding-tb-50">
    <div class="container">
        <div class="row mb-minus-24">
            <div class="col-lg-5 col-12 mb-24">
                <div class="bb-category-img">
                    <img src="{{asset('assets')}}/img/category/category.jpg" alt="category">
                    <div class="bb-offers">
                        <span>50% Off</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-12 mb-24">
                <div class="bb-category-contact">
                    <div class="category-title" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
                        <h2>Khám phá danh mục</h2>
                    </div>
                    <div class="bb-category-block owl-carousel">
                       @foreach ($category as $item)
                       <a href="{{route('user.findcategory',$item->name)}}">
                        <div class="bb-category-box category-items-2" data-aos="flip-left" data-aos-duration="1000"
                        data-aos-delay="200">
                        <div class="category-image">
                            <img src="{{asset('assets')}}/img/category/{{$item->name}}.svg" alt="category">
                        </div>
                        <div class="category-sub-contact">
                            <h5>{{$item->name}}</h5>
                            <p>xem</p>
                        </div>
                        </div>
                    </a>
                       @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Day of the deal -->
<section class="section-deal padding-tb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title bb-deal" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <div class="section-detail">
                        <h2 class="bb-title">Sản phẩm nổi bật hằng ngày</span></h2>
                    </div>
                    <div id="dealend" class="dealend-timer"></div>
                </div>
            </div>
            <div class="col-12">
                <div class="bb-deal-slider">
                    <div class="bb-deal-block owl-carousel">
                        @foreach ($product as $item )
                        <div class="bb-deal-card" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                            <div class="bb-pro-box">
                                <div class="bb-pro-img">
                                    <span class="flags">
                                        <span>New</span>
                                    </span>
                                    <a href="{{route('user.product',$item->slug)}}">
                                        <div class="inner-img">
                                            <img class="main-img" src="{{asset('storage/images')}}/{{$item->image}}" alt="product-1">
                                            <img class="hover-img" src="{{asset('storage/images')}}/{{$item->image}}"
                                                alt="product-1">
                                        </div>
                                    </a>
                                </div>
                                <div class="bb-pro-contact">
                                    <div class="bb-pro-subtitle">
                                        <a href="shop-left-sidebar-col-3.html">Chocos</a>
                                        <span class="bb-pro-rating">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-line"></i>
                                        </span>
                                    </div>
                                    <h4 class="bb-pro-title"><a href="product-left-sidebar.html">{{$item->name}}</a>
                                    </h4>
                                    <div class="bb-price">
                                        <div class="inner-price">
                                            @if ($item->sale_price)
                                            <span class="new-price">{{$item->sale_price}}</span>
                                            <span class="old-price">{{$item->price}}</span>
                                            @else
                                            <span class="new-price">{{$item->price}}</span>
                                            @endif
                                        </div>
                                        <span class="last-items">1 gói</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Banner-one -->
<section class="section-banner-one padding-tb-50">
    <div class="container">
        <div class="row mb-minus-24">
            <div class="col-lg-6 col-12 mb-24" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                <div class="banner-box bg-box-color-one">
                    <div class="inner-banner-box">
                        <div class="side-image">
                            <img src="{{asset('assets')}}/img/banner-one/one.png" alt="one">
                        </div>
                        <div class="inner-contact">
                            <h5>Đồ ăn nhanh</h5>
                            <a href="{{route('user.findcategory','Bánh kẹo')}}" class="bb-btn-1">Xem</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12 mb-24" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                <div class="banner-box bg-box-color-two">
                    <div class="inner-banner-box">
                        <div class="side-image">
                            <img src="{{asset('assets')}}/img/banner-one/two.png" alt="two">
                        </div>
                        <div class="inner-contact">
                            <h5>Rau củ quả</h5>
                            <a href="{{route('user.findcategory','Rau củ - Trái cây')}}" class="bb-btn-1">Xem</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- New Product tab Area -->
<section class="section-product-tabs padding-tb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title bb-deal" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <div class="section-detail">
                        <h2 class="bb-title">Hàng mới về</h2>
                        <p>Mua sắm trực tuyến cho những người mới đến và nhận giao hàng miễn phí!</p>
                    </div>
                    <div class="bb-pro-tab">
                        <ul class="bb-pro-tab-nav nav">
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#all">tất cả</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-minus-24">
            <div class="col">
                <div class="tab-content">
                    <!-- 1st Product tab start -->
                    <div class="tab-pane fade" id="all">
                        <div class="row">
                            @foreach ($productAll as $item)
                            <div class="col-xl-3 col-md-4 col-6 mb-24 bb-product-box" data-aos="fade-up"
                            data-aos-duration="1000" data-aos-delay="200">
                            <div class="bb-pro-box">
                                <div class="bb-pro-img">
                                    <span class="flags">
                                        <span>New</span>
                                    </span>
                                    <a href="{{route('user.product',$item->slug)}}">
                                        <div class="inner-img">
                                            <img class="main-img" src="{{asset('storage/images')}}/{{$item->image}}" alt="product-1">
                                            <img class="hover-img" src="{{asset('storage/images')}}/{{$item->image}}"
                                                alt="product-1">
                                        </div>
                                    </a>
                                </div>
                                <div class="bb-pro-contact">
                                    <div class="bb-pro-subtitle">
                                        <a href="shop-left-sidebar-col-3.html">Chocos</a>
                                        <span class="bb-pro-rating">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-line"></i>
                                        </span>
                                    </div>
                                    <h4 class="bb-pro-title"><a href="product-left-sidebar.html">{{$item->name}}</a>
                                    </h4>
                                    <div class="bb-price">
                                        <div class="inner-price">
                                            @if ($item->sale_price)
                                            <span class="new-price">{{$item->sale_price}}</span>
                                            <span class="old-price">{{$item->price}}</span>
                                            @else
                                            <span class="new-price">{{$item->price}}</span>
                                            @endif
                                        </div>
                                        <span class="last-items">1 gói</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- 2nd Product tab start -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services -->
<section class="section-services padding-tb-50">
    <div class="container">
        <div class="row mb-minus-24">
            <div class="col-lg-3 col-md-6 col-12 mb-24" data-aos="flip-up" data-aos-duration="1000"
                data-aos-delay="200">
                <div class="bb-services-box">
                    <div class="services-img">
                        <img src="{{asset('assets')}}/img/services/1.png" alt="services-1">
                    </div>
                    <div class="services-contact">
                        <h4>Miễn phí vận chuyển</h4>
                        <p>Miễn phí vận chuyển cho tất cả đơn hàng của chúng tôi hoặc trên 1 triệu</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-24" data-aos="flip-up" data-aos-duration="1000"
                data-aos-delay="400">
                <div class="bb-services-box">
                    <div class="services-img">
                        <img src="{{asset('assets')}}/img/services/2.png" alt="services-2">
                    </div>
                    <div class="services-contact">
                        <h4>Hỗ trợ 24x7</h4>
                        <p>Liên hệ với chúng tôi 24 giờ một ngày, 7 ngày một tuần</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-24" data-aos="flip-up" data-aos-duration="1000"
                data-aos-delay="600">
                <div class="bb-services-box">
                    <div class="services-img">
                        <img src="{{asset('assets')}}/img/services/3.png" alt="services-3">
                    </div>
                    <div class="services-contact">
                        <h4>Hoàn trả trong 12 giờ</h4>
                        <p></p>
                    </div>Đơn giản chỉ cần trả lại trong vòng 12 giờ để trao đổi
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-24" data-aos="flip-up" data-aos-duration="1000"
                data-aos-delay="800">
                <div class="bb-services-box">
                    <div class="services-img">
                        <img src="{{asset('assets')}}/img/services/4.png" alt="services-4">
                    </div>
                    <div class="services-contact">
                        <h4>Thanh toán an toàn</h4>
                        <p>Liên hệ với chúng tôi 24 giờ một ngày, 7 ngày một tuần</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Instagram -->
<section class="section-instagram padding-tb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bb-instagram-slider owl-carousel">
                    <div class="bb-instagram-card" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                        <div class="instagram-img">
                            <a href="javascript:void(0)">
                                <img src="{{asset('assets')}}/img/instagram/1.jpg" alt="instagram-1">
                            </a>
                        </div>
                    </div>
                    <div class="bb-instagram-card" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                        <div class="instagram-img">
                            <a href="javascript:void(0)">
                                <img src="{{asset('assets')}}/img/instagram/2.jpg" alt="instagram-2">
                            </a>
                        </div>
                    </div>
                    <div class="bb-instagram-card" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                        <div class="instagram-img">
                            <a href="javascript:void(0)">
                                <img src="{{asset('assets')}}/img/instagram/3.jpg" alt="instagram-3">
                            </a>
                        </div>
                    </div>
                    <div class="bb-instagram-card" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
                        <div class="instagram-img">
                            <a href="javascript:void(0)">
                                <img src="{{asset('assets')}}/img/instagram/4.jpg" alt="instagram-4">
                            </a>
                        </div>
                    </div>
                    <div class="bb-instagram-card" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
                        <div class="instagram-img">
                            <a href="javascript:void(0)">
                                <img src="{{asset('assets')}}/img/instagram/5.jpg" alt="instagram-5">
                            </a>
                        </div>
                    </div>
                    <div class="bb-instagram-card" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="700">
                        <div class="instagram-img">
                            <a href="javascript:void(0)">
                                <img src="{{asset('assets')}}/img/instagram/6.jpg" alt="instagram-6">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('user.footer')
@include('user.slider')
@endsection
