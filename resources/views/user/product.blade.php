@extends('user.master')
@section('title', 'product')
@section('main-content')
@include('user.header')
<section class="section-product padding-tb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bb-single-pro">
                    <div class="row">
                        <div class="col-lg-5 col-12 mb-24">
                            <div class="single-pro-slider">
                                <div class="single-product-cover">
                                    <div class="single-slide img-zoom zoom-image-hover">
                                        <img class="img-responsive" src="{{asset('storage/images')}}/{{$product->image}}"
                                            alt="product-1" data-action="zoom">
                                    </div>
                                    @foreach ($product->images as $item)
                                        <div class="single-slide img-zoom zoom-image-hover">
                                        <img class="img-responsive" src="{{asset('storage/images')}}/{{$item->image}}"
                                            alt="product-1" data-action="zoom">
                                    </div>
                                    @endforeach
                                    
                                </div>
                                <div class="single-nav-thumb">
                                    <div class="single-slide">
                                        <img class="img-responsive" src="{{asset('storage/images')}}/{{$product->image}}"
                                            alt="product-1">
                                    </div>
                                    @foreach ( $product->images as $item)
                                        <div class="single-slide">
                                        <img class="img-responsive" src="{{asset('storage/images')}}/{{$item->image}}"
                                            alt="product-1">
                                    </div>
                                    @endforeach
                                    
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-12 mb-24">
                            <div class="bb-single-pro-contact">
                                <div class="bb-sub-title">
                                    <h4>{{$product->name}}</h4>
                                </div>
                                <div class="bb-single-rating">
                                    <span class="bb-pro-rating">
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-line"></i>
                                    </span>
                                </div>
                                <div class="bb-single-price-wrap">
                                    <div class="bb-single-price">
                                        @if ($product->sale_price)
                                        <div class="price">
                                           
                                            <h5> {{ number_format($product->sale_price, 0, ',', '.') }} đ <span>  -{{discountPercentage($product->price,$product->sale_price)}}%</span></h5>
                                        </div>
                                        <div class="mrp">
                                            <p>M.R.P. : <span> {{ number_format($product->price, 0, ',', '.') }} đ</span></p>
                                        </div>
                                        @else
                                        <div class="price">
                                            <h5> {{ number_format($product->price, 0, ',', '.') }} đ</h5>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="bb-single-qty">
                                    
                                    <form action="{{ route('cart.add') }}" method="POST" class="d-flex">
                                        @csrf
                                        <div class="qty-plus-minus"><div class="dec bb-qtybtn">-</div>
                                            <input class="qty-input" type="text" name="quantity" value="1">
                                        <div class="inc bb-qtybtn">+</div></div>
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <button type="submit" class="bb-btn-2 mx-2">Thêm vào giỏ hàng</button>
                                    </form>
                                </div>
                                <script>
                                   document.querySelectorAll('.bb-qtybtn').forEach(function(btn) {
                                        btn.addEventListener('click', function() {             
                                            var input = this.parentNode.querySelector('.qty-input');
                                            var currentValue = parseInt(input.value)+1;       
                                            if (this.innerText === "+") {
                                                if(currentValue>{{$product->discount}}){
                                                alert('Vượt quá số lượng');
                                                input.value={{$product->discount}}-1;
                                            }
                                            } 
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bb-single-pro-tab">
                    <div class="bb-pro-tab">
                        <ul class="bb-pro-tab-nav nav">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#detail">Detail</a>
                            </li>
                            
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="detail">
                            <div class="bb-inner-tabs">
                                <div class="bb-details">
                                    {!!$product->description!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related product section -->
<section class="section-related-product padding-tb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title bb-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <div class="section-detail ">
                        <h2 class="bb-title">Sản phẩm <span>Tương tự</span></h2>
                        <p>Browse The Collection of Top Products.</p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="bb-deal-slider">
                    <div class="bb-deal-block owl-carousel">
                        
                        @foreach($productcate as $item)
                        <div class="bb-deal-card" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
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
                                        <span class="last-items">1 Pack</span>
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
@include('user.footer')
@endsection
