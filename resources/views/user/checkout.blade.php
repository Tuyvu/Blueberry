
@extends('user.master')
@section('title', 'cart')
@section('main-content')
@include('user.header')
<section class="section-checkout padding-tb-50">
    <div class="container">
        <form action="{{route('cart.checkoutview')}}" method="post">
            @csrf
            <input type="hidden" name="order_id" value="{{ $orderid }}">
            <div class="row mb-minus-24">
            
                <div class="col-lg-8 col-12 mb-24">
                    <div class="bb-checkout-contact aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                        <div class="main-title">
                            <h4>Hóa đơn</h4>
                        </div>
                        <div class="checkout-radio">
                            <div class="radio-itens">
                                <input type="radio" id="address1" name="address" checked="" value="old">
                                <label for="address1">Tôi muốn sử dụng một địa chỉ hiện có</label>
                            </div>
                            <div class="radio-itens">
                                <input type="radio" id="address2" name="address" data-bs-toggle="modal" value="new" data-bs-target="#newAddressModal">
                                <label for="address2">Tôi muốn sử dụng địa chỉ mới</label>
                            </div>
                        </div>
                        <br>
                        <div class="checkout-items aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                            <div class="sub-title">
                                <h4>Phương thức giao hàng</h4>
                            </div>
                            <div class="checkout-method">
                                <div class="bb-del-option">
                                    <div class="checkout-radio">
                                        <div class="radio-itens">
                                            <input type="radio" id="rate1" name="rate" value="30000" checked>
                                            <label for="rate1">Giao hàng nhanh</label>
                                            <br>
                                            <label class="ps-4" for="rate1">30,000đ</label>
                                        </div>
                                        <div class="radio-itens">
                                            <input type="radio" id="rate2" name="rate" value="15000">
                                            <label for="rate2">Giao hàng thường</label>
                                            <br>
                                            <label class="ps-4" for="rate2">15,000đ</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="about-order">
                                <h5>Ghi chú</h5>
                                <textarea name="your_commemt" placeholder="Comments"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="checkout-items aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
                            <div class="sub-title">
                                <h4>Phương thức thanh toán</h4>
                            </div>
                            <div class="checkout-method">
                                <div class="bb-del-option">
                                    <div class="inner-del">
                                        <div class="radio-pay">
                                            <input type="radio" id="Cash1" name="radio_pay" checked="" value="pay">
                                            <label for="Cash1">Thanh toán khi nhận hàng</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="bb-del-option">
                                    <div class="inner-del">
                                        <div class="radio-pay">
                                            <input type="radio" id="Cash2" name="radio_pay" value="vnpay">
                                            <label for="Cash2">Thanh toán qua VNPay</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 mb-24">
                    <div class="bb-checkout-sidebar">
                        <div class="checkout-items aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                            
                            <div class="bb-checkout-pro">

                                @foreach ($products as $item)
                                <div class="pro-items">
                                    <div class="image">
                                        <img src="{{asset('storage/images')}}/{{$item['product']->image}}" alt="{{$item['product']->image}}">
                                    </div>
                                    <div class="items-contact">
                                        <h4><a href="javascript:void(0)">{{$item['product']->name}}</a></h4>
                                        <div class="inner-price">
                                            @if ($item['product']->sale_price)
                                                <span class="new-price">{{$item['product']->sale_price}}</span>
                                                <span class="old-price">{{$item['product']->price}}</span>
                                                @else
                                                <span class="new-price">{{$item['product']->price}}</span>
                                                @endif
                                        </div>
                                        <div class="inner-price">
                                            <p>x{{$item['quantity']}}</p>
                                        </div>
                                    </div>
                                </div>
                                    
                                @endforeach
                            </div>
                            
                        </div>
                        <div class="sub-title">
                            <h4>Chi tiết thanh toán</h4>
                        </div>
                        <div class="checkout-summary">
                            <ul>
                                <li><span class="left-item">Tổng tiền hàng</span><span>{{$totalMoney}}</span>
                                    <input type="hidden" id="total-price1-input" name="total-price" value="{{$totalMoney}}"></li></li>
                                <li><span class="left-item">Cước vận chuyển</span><span id="shipping-fee">30,000đ</span></li>
                                <li>
                                    <span class="left-item">Phiếu giảm giá</span>
                                    <span><a href="javascript:void(0)" class="apply drop-coupon">Áp mã</a></span>
                                </li>
                                <li>
                                    <div class="coupon-down-box" style="display: none;">
                                        <form method="post">
                                            <input class="bb-coupon" type="text" placeholder="Enter Your coupon Code" name="bb-coupon">
                                            <button class="bb-btn-2" type="submit">chọn</button>
                                        </form>
                                    </div>
                                </li> 
                                <li><span class="left-item">Tổng thanh toán</span><span id="total-payment">{{ number_format($totalMoney + 30000, 0, ',', '.') }}đ</span>
                                    <input type="hidden" id="total-payment-input" name="total_payment" value="{{ sumtotal($totalMoney,30000) }}"></li></li>                               
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="input-button">
                        <button type="submit" name="redirect" class="bb-btn-2">Thanh toán</button>
                    </div>
                </div>   
                <div class="modal fade" id="newAddressModal" tabindex="-1" aria-labelledby="newAddressModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="newAddressModalLabel">Thêm địa chỉ mới</h5>
                            </div>
                            <div class="modal-body">
                                    <!-- Last Name -->
                                    <div class="bb-register-wrap bb-register-width-50">
                                        <label>Họ & Tên*</label>
                                        <input type="text" name="fullname" placeholder="Họ tên" value="{{ old('lastname') }}">
                                    </div>
                                    <br>
                                    <!-- Phone Number -->
                                    <div class="bb-register-wrap bb-register-width-50">
                                        <label>SĐT*</label>
                                        <input type="text" name="phone" placeholder="Nhập số điện thoại" value="{{ old('phone') }}">
                                    </div>
                                    <br>
                                    <div class="bb-register-wrap bb-register-width-50">
                                        <label>Tỉnh/Thành phố*</label>
                                        <div class="custom-select">
                                            <div class="select"><select class="hide-select" name="city" id="city-select">
                                                <option value="" id="city-select-one" disabled selected>Chọn thành phố</option>
                                                @foreach ($cities as $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="bb-register-wrap bb-register-width-50">
                                        <label>Quốc Gia*</label>
                                        <input type="text" value="Việt Nam" enable="false">
                                    </div>
                                    <br>
                                    <div class="bb-register-wrap bb-register-width-100">
                                        <label>Địa chỉ*</label>
                                        <input type="text" name="address_detail" placeholder="Địa chỉ cụ thể">
                                    </div>
                                    
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeModalBtn">Đóng</button>
                                <button type="button" class="btn btn-primary" id="saveAddressBtn">Lưu địa chỉ</button>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
            
        </form>
    </div>
    {{-- modal --}}
    <script>
        let x=false;
        document.getElementById('address1').addEventListener('click', function() {
            if( document.getElementById('address1').checked == true){
            x=false;
        }
        });
        // Sự kiện cho nút "Đóng" của modal
        document.getElementById('closeModalBtn').addEventListener('click', function() {
            // Khi modal đóng, đặt radio về trạng thái mặc định
            if(x==false){
            document.getElementById('address1').checked = true;
            document.getElementById('address2').checked = false;
            x=false;
           }
        });
    
        // Sự kiện khi modal bị ẩn (bằng bất kỳ cách nào)
        var newAddressModal = document.getElementById('newAddressModal');
        newAddressModal.addEventListener('hidden.bs.modal', function () {
           if(x==false){
            document.getElementById('address1').checked = true;
            document.getElementById('address2').checked = false;
            x=false;
           }
        });
    
        // Sự kiện cho nút "Lưu địa chỉ" chỉ đóng modal và giữ nguyên radio
        document.getElementById('saveAddressBtn').addEventListener('click', function() {
            var modal = bootstrap.Modal.getInstance(newAddressModal);
            x=true;
            modal.hide();  
        });
        
    </script>
    <script>
        // Biến chứa tổng tiền từ PHP (totalMoney là giá trị số nguyên)
        const totalMoney = {{$totalMoney}};
    
        // Lấy các phần tử radio
        const rate1 = document.getElementById('rate1');
        const rate2 = document.getElementById('rate2');
        const shippingFee = document.getElementById('shipping-fee');
        const totalPayment = document.getElementById('total-payment');
        const totalPaymentinput = document.getElementById('total-payment-input');
    
        // Hàm định dạng số thành kiểu tiền tệ
        function formatCurrency(value) {
            return value.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        }
    
        // Hàm để cập nhật cước vận chuyển và tổng thanh toán
        function updatePayment() {
            let shippingCost = 0;
    
            // Xác định cước vận chuyển dựa trên radio được chọn
            if (rate1.checked) {
                shippingCost = 30000;
                shippingFee.textContent = '30,000đ';
            } else if (rate2.checked) {
                shippingCost = 15000;
                shippingFee.textContent = '15,000đ';
            }
    
            // Tính tổng thanh toán
            const total = totalMoney + shippingCost;
    
            // Cập nhật giá trị tổng thanh toán
            totalPayment.textContent = formatCurrency(total);
            totalPaymentinput.value=total;
        }
    
        // Lắng nghe sự thay đổi khi chọn radio
        rate1.addEventListener('change', updatePayment);
        rate2.addEventListener('change', updatePayment);
    </script>
</section>
@include('user.footer')
@include('user.slider')
@endsection