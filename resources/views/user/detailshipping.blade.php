@extends('user.master')
@section('title', 'Home')
@section('main-content')
@include('user.header')
<section class="section-checkout padding-tb-50">
    <div class="container">
        <h1>Theo dõi đơn hàng</h1>
        <x-shiping-component :orders="$orders"/>
        @if ($orders->status==2)
        <a href="{{route('user.finishshiping',$orders)}}" class="btn btn-primary">Đã nhận được hàng</a> 
        @else          
        <a class="btn btn-secondary">Đã nhận được hàng</a>                
        @endif
    </div>
</section>

@include('user.footer')
@include('user.slider')
@endsection