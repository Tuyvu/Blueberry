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
                                    <span class="bb-read-review">
                                        |&nbsp;&nbsp;<a href="#bb-spt-nav-review">992 Ratings</a>
                                    </span>
                                </div>
                                {!!$product->description!!}
                                <div class="bb-single-price-wrap">
                                    <div class="bb-single-price">
                                        @if ($product->sale_price)
                                        <div class="price">
                                            <h5>{{$product->sale_price}} <span>-78%</span></h5>
                                        </div>
                                        <div class="mrp">
                                            <p>M.R.P. : <span>{{$product->price}}</span></p>
                                        </div>
                                        @else
                                        <div class="price">
                                            <h5>{{$product->price}}</h5>
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
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#information">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#reviews">Reviews</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="detail">
                            <div class="bb-inner-tabs">
                                <div class="bb-details">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, voluptatum.
                                        Vitae dolores alias repellat eligendi, officiis, exercitationem corporis
                                        quisquam delectus cum non recusandae numquam dignissimos molestiae magnam
                                        hic natus. Cumque.</p>
                                    <div class="details-info">
                                        <ul>
                                            <li>Any Product types that You want - Simple, Configurable</li>
                                            <li>Downloadable/Digital Products, Virtual Products</li>
                                            <li>Inventory Management with Backordered items</li>
                                            <li>Flatlock seams throughout.</li>
                                        </ul>
                                        <ul>
                                            <li><span>Highlights</span>Form FactorWhole</li>
                                            <li><span>Seller</span>No Returns Allowed</li>
                                            <li><span>Services</span>Cash on Delivery available</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="information">
                            <div class="bb-inner-tabs">
                                <div class="information">
                                    <ul>
                                        <li><span>Weight</span> 500 g</li>
                                        <li><span>Dimensions</span> 17 × 15 × 3 cm</li>
                                        <li><span>Color</span> black,yellow,red</li>
                                        <li><span>Brand</span> Wonder Fort</li>
                                        <li><span>Form Factor</span>Whole</li>
                                        <li><span>Quantity</span>1</li>
                                        <li><span>Container Type</span>Pouch</li>
                                        <li><span>Shelf Life</span>12 Months</li>
                                        <li><span>Ingredients</span>Dalchini, Dhaniya, Badi Elaichi, Laung</li>
                                        <li><span>Other Features</span>Ingredient Type: Vegetarian</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="reviews">
                            <div class="bb-inner-tabs">
                                <div class="bb-reviews">
                                    <div class="reviews-bb-box">
                                        <div class="inner-image">
                                            <img src="{{asset('assets')}}/img/reviews/1.jpg" alt="img-1">
                                        </div>
                                        <div class="inner-contact">
                                            <h4>Mariya Lykra</h4>
                                            <div class="bb-pro-rating">
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-line"></i>
                                            </div>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo, hic
                                                expedita asperiores eos neque cumque impedit quam, placeat
                                                laudantium soluta repellendus possimus a distinctio voluptate
                                                veritatis nostrum perspiciatis est! Commodi!</p>
                                        </div>
                                    </div>
                                    <div class="reviews-bb-box">
                                        <div class="inner-image">
                                            <img src="{{asset('assets')}}/img/reviews/2.jpg" alt="img-2">
                                        </div>
                                        <div class="inner-contact">
                                            <h4>Saddika Alard</h4>
                                            <div class="bb-pro-rating">
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-line"></i>
                                            </div>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo, hic
                                                expedita asperiores eos neque cumque impedit quam, placeat
                                                laudantium soluta repellendus possimus a distinctio voluptate
                                                veritatis nostrum perspiciatis est! Commodi!</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bb-reviews-form">
                                    <h3>Add a Review</h3>
                                    <div class="bb-review-rating">
                                        <span>Your ratting :</span>
                                        <div class="bb-pro-rating">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-line"></i>
                                        </div>
                                    </div>
                                    <form action="#">
                                        <div class="input-box">
                                            <input type="text" placeholder="Name" name="your-name">
                                        </div>
                                        <div class="input-box">
                                            <input type="email" placeholder="Email" name="your-email">
                                        </div>
                                        <div class="input-box">
                                            <textarea name="your-comment"
                                                placeholder="Enter Your Comment"></textarea>
                                        </div>
                                        <div class="input-button">
                                            <a href="{{route('cart.view')}}" class="bb-btn-2">Thêm vào giỏ hàng</a>
                                        </div>
                                    </form>
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
