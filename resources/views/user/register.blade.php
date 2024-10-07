@extends('user.master')
<section class="section-register padding-tb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bb-register aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title bb-center">
                                <div class="section-detail">
                                    <h2 class="bb-title">Đăng <span>Ký</span></h2>
                                    <p>Nơi tốt nhất để mua sản phẩm sạch</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <form action="" method="post">
                                @csrf
                                <!-- First Name -->
                                <div class="bb-register-wrap bb-register-width-50">
                                    <label>Họ*</label>
                                    <input type="text" name="firstname" placeholder="Họ" value="{{ old('firstname') }}">
                                    @if ($errors->has('firstname'))
                                        <div class="error-message" style="color: red;">
                                            {{ $errors->first('firstname') }}
                                        </div>
                                    @endif
                                </div>
                        
                                <!-- Last Name -->
                                <div class="bb-register-wrap bb-register-width-50">
                                    <label>Tên*</label>
                                    <input type="text" name="lastname" placeholder="Tên" value="{{ old('lastname') }}">
                                    @if ($errors->has('lastname'))
                                        <div class="error-message" style="color: red;">
                                            {{ $errors->first('lastname') }}
                                        </div>
                                    @endif
                                </div>
                        
                                <!-- Email -->
                                <div class="bb-register-wrap bb-register-width-50">
                                    <label>Email*</label>
                                    <input type="email" name="email" placeholder="Nhập Email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <div class="error-message" style="color: red;">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                        
                                <!-- Phone Number -->
                                <div class="bb-register-wrap bb-register-width-50">
                                    <label>SĐT*</label>
                                    <input type="text" name="phone" placeholder="Nhập số điện thoại" value="{{ old('phone') }}">
                                    @if ($errors->has('phone'))
                                        <div class="error-message" style="color: red;">
                                            {{ $errors->first('phone') }}
                                        </div>
                                    @endif
                                </div>
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
                                
                                <!-- Phone Number -->
                                <div class="bb-register-wrap bb-register-width-50">
                                    <label>Quốc Gia*</label>
                                    <input type="text" value="Việt Nam" enable="false">
                                </div>
                                <div class="bb-register-wrap bb-register-width-100">
                                    <label>Địa chỉ*</label>
                                    <input type="text" name="address" placeholder="Địa chỉ cụ thể">
                                </div>
                                <!-- Password -->
                                <div class="bb-register-wrap bb-register-width-100">
                                    <label for="password">Mật khẩu*</label>
                                    <div style="position: relative;">
                                        <input type="password" id="password" name="password" placeholder="Nhập mật khẩu">
                                        <span id="togglePassword" style="cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                                            👁️
                                        </span>
                                    </div>
                                </div>
                                @if ($errors->has('password'))
                                    <div class="error-message" style="color: red;">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                        
                                <!-- Submit Button -->
                                <div class="bb-login-button">
                                    <button type="submit" class="bb-btn-2">Đăng ký</button>
                                    <a class="" href="{{route('user.login')}}">Đăng nhập</a>
                                </div>
                                
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const passwordType = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', passwordType);
        this.textContent = passwordType === 'password' ? '👁️' : '🙈'; // Chuyển đổi icon
    });
</script>
