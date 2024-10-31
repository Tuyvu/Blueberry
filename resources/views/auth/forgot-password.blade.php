@extends('user.master')
<section class="section-login padding-tb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title bb-center aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <div class="section-detail">
                        <a href="{{route('user.index')}}">
                                        <img src="{{asset('assets')}}/img/logo/logo.png" alt="logo" style="margin-bottom: 26px;margin-right: 8px;" class="light">
                        </a>
                        <h2 class="bb-title">Xác Nhận <span>Mật khẩu</span></h2>
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
                    <form form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="bb-login-wrap">
                            <label for="email">Email*</label>
                            <input type="email" id="email" name="email" placeholder="Nhập Email">
                        </div>
                        @error('email')
                        <span style="color: red;">{{ $message }}</span>
                        @enderror
                        <div class="bb-login-button">
                            <button class="bb-btn-2" type="submit">Xác nhận</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
