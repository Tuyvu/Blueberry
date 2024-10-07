
@extends('user.master')
@section('title', 'cart')
@section('main-content')
@include('user.header')
<section class="section-cart padding-tb-50">
    <div class="container">
        <div class="row mb-minus-24">
            
            <div class="col-lg-8 mb-24">
                <div class="bb-cart-table aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng tiền</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $item)
                                <tr>
                                    <input type="hidden" class="product_id" name="product_id" value="{{$item->product_id}}">
                                    <td><span><input type="checkbox" id="status" data-price="{{$item->price}}" data-id="total-price-item-{{$item->id}}"></span></td>
                                    <td>
                                        <a href="javascript:void(0)">
                                            <div class="Product-cart">
                                                <img src="{{asset('storage/images')}}/{{$item->image}}" alt="new-product-4">
                                                <span>{{$item->name}}</span>
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        <span id="price1" class="price" data-price="{{$item->price}}">{{ number_format($item->price, 0, ',', '.') }} đ</span>
                                    </td>
                                    <td>
                                        <div class="qty-plus-minus"><div class="dec bb-qtybtn">-</div>
                                            <input class="qty-input" type="text" id="quantity" name="bb-qtybtn" value="{{$item->quantity}}">
                                        <div class="inc bb-qtybtn">+</div></div>
                                    </td>
                                    <script>
                                        document.querySelectorAll('.bb-qtybtn').forEach(function(btn) {
                                             btn.addEventListener('click', function() {             
                                                 var input = this.parentNode.querySelector('.qty-input');
                                                 var currentValue = parseInt(input.value)+1;       
                                                 if (this.innerText === "+") {
                                                     if(currentValue>{{$item->product->discount}}){
                                                     alert('Vượt quá số lượng');
                                                     input.value={{$item->product->discount}}-1;
                                                 }
                                                 } 
                                             });
                                         });
                                     </script>
                                    <td>
                                        <span class="totalprice">{{ number_format(TotalPriceItem($item->price,$item->quantity), 0, ',', '.') }} đ</span>
                                        <input type="hidden" id="total-price-item-{{$item->id}}" class="total-price-item" value="{{ number_format(TotalPriceItem($item->price,$item->quantity), 0, ',', '.') }}" name="total-price-item">
                                    </td>
                                    <td>
                                        <div class="pro-remove">
                                            <a href="{{route('cart.delete',$item->product_id)}}" onclick="return confirmDelete();">
                                                <i class="ri-delete-bin-line"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>                    
            </div><script>
                function confirmDelete() {
                    return confirm("Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?");
                }
            </script>
            <div class="col-lg-4 mb-24">
                <div class="bb-cart-sidebar-block aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <div class="bb-sb-title">
                        <h3>Tổng</h3>
                    </div>
                    <div class="bb-sb-blok-contact">
                        <div class="bb-cart-summary">
                            <div class="inner-summary">
                                <ul>
                                    <li><span class="text-left">Tổng tiền hàng</span><span id="total-price" class="text-right">0đ</span>
                                    <input type="hidden" id="total-price-input" name="total-price"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{route('cart.checkout')}}" method="post">
            @csrf
            <input type="hidden" name="selectedProductsJson" id="selectedProductsJson">
            <button type="submit" class="bb-btn-2 check-btn" id="checkoutForm" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400" onclick="submitCheckout()">Đặt hàng</button>
        </form>
        
        {{-- <button class="bb-btn-2 check-btn aos-init aos-animate" data-aos="fade-up" onclick="submitCheckout()" data-aos-duration="1000" data-aos-delay="400">Check Out</button> --}}
        <script>
            function submitCheckout(event) {
        let selectedProducts = [];

        document.querySelectorAll('input[type="checkbox"]:checked').forEach(function(checkbox) {
            let row = checkbox.closest('tr');
            let productId = row.querySelector('.product_id').value;
            let quantity = row.querySelector('.qty-input').value;
            let price = row.querySelector('.price').dataset.price;
            let totalprice = row.querySelector('.total-price-item').value;

            selectedProducts.push({
                product_id: productId,
                quantity: quantity,
                price: price,
                totalprice: totalprice
            });
        });
            let selectedProductsJson = JSON.stringify(selectedProducts);
            document.getElementById('selectedProductsJson').value = selectedProductsJson;
        }
        </script>
    </div>
</section>
@include('user.footer')
@include('user.slider')
@endsection