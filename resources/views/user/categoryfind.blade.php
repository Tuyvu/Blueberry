@extends('user.master')
@section('title', 'product')
@section('main-content')
@include('user.header')
<section class="section-shop padding-b-50">
    <div class="container">
        <div class="row">
            <div class="bb-shop-overlay"></div>
            <div class="col-12">
                <div class="bb-shop-pro-inner">
                    <div class="row mb-minus-24">
                        <div class="col-12">
                            <div class="bb-pro-list-top">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="bb-bl-btn">
                                            <button type="button" class="grid-btn btn-grid-100 active">
                                                <i class="ri-apps-line"></i>
                                            </button>
                                            <button type="button" class="grid-btn btn-list-100">
                                                <i class="ri-list-unordered"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach ($products as $item )
                        <div class="col-lg-3 col-md-4 col-6 mb-24 bb-product-box pro-bb-content aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
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
                                        <a href="#">{{$item->category->name}}</a>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {!! $products->links('pagination::custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('user.footer')
@endsection
