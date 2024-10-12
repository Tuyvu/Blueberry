@extends('user.master')
@section('title', 'Home')
@section('main-content')
@include('user.header')
<section class="section-checkout padding-tb-50">
    <div class="container">
        <h1>Đặt hàng thành công</h1>
        <a href="{{route('user.shiping')}}" class="bb-btn-2">theo dõi đơn hàng</a>                
    </div>
</section>

@include('user.footer')
@include('user.slider')
@endsection
