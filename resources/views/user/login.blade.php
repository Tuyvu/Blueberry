@extends('user.master')
<section class="section-login padding-tb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title bb-center aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <div class="section-detail">
                        <h2 class="bb-title">Đăng <span>Nhập</span></h2>
                        <p>Nơi tốt nhất để mua và bán các sản phẩm</p>
                    </div>
                </div>
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
            </div>
            <div class="col-12">
                <div class="bb-login-contact aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                    <form action="" method="POST">
                        @csrf
                        <div class="bb-login-wrap">
                            <label for="email">Email*</label>
                            <input type="email" id="email" name="email" placeholder="Nhập Email">
                        </div>
                        <div class="bb-login-wrap">
                            <label for="password">Mật khẩu*</label>
                            <div style="position: relative;">
                                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu">
                                <span id="togglePassword" style="cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                                    👁️
                                </span>
                            </div>
                        </div>
                        <div class="bb-login-wrap">
                            <a href="{{route('password.request')}}">Quên mật khẩu?</a>
                        </div>
                        <div class="bb-login-button">
                            <button class="bb-btn-2" type="submit">Đăng nhập</button>
                            <a href="{{route('user.register')}}">Đăng ký</a>
                        </div>
                    </form>
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
