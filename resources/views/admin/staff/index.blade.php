@extends('admin.layouts.master')
@section('title','homeadmin')
@section('mainad-content')
<div class="page-wrapper">

    <!-- Page Content-->
    <div class="page-content">
        <div class="container-xxl">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-9 m-b-xs">
                        <h1 class="btn btn-success">Nhân viên</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-9 m-b-xs">
                        <a href="{{route('sadmin.addstaff')}}" class="btn btn-success">Thêm mới nhân viên</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
            
                            <th>#</th>
                            <th>tên</th>
                            <th>email</th>
                            <th>Số điện thoại</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($user as $index =>$item)
                        <tr>
                            <td>{{ $user->firstItem() + $index }}</td>
                            <td>{{$item->firstname}} {{$item->lastname}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->phone}}</td>
                        </tr>
                        @empty
                        <tr>
                            <span>chưa có dữ liệu</span>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {!! $user->links('pagination::bootstrap-5') !!}
            </div>
        </div><!-- container -->

        <!--Start Rightbar-->
        <!--Start Rightbar/offcanvas-->

        <!--end footer-->
    </div>
    <!-- end page content -->
</div>
@endsection