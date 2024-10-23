@extends('admin.layouts.master')
@section('title','homeadmin')
@section('mainad-content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="container-xxl">
            <!-- Page Content-->
            <div class="col-md-8">
                <div class="row">
                    <div class="col-sm-9 m-b-xs">
                        <a href="{{route('sadmin.staff')}}" class="btn btn-success">back</a>
                    </div>
                </div>
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm mới Nhân viên</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ route('sadmin.addstaff') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group @error('name') has-error @enderror">
                                    <div class="col-md-6">
                                        <label for="productname">Họ</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Họ" value="{{ old('lastname') }}">
                                        @error('lastname')
                                            <span class="help-block" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="productname">Tên nhân viên</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="tên nhân viên" value="{{ old('firstname') }}">
                                        @error('firstname')
                                            <span class="help-block" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group @error('price') has-error @enderror">
                                    <div class="col-md-6">
                                        <label for="productname">email</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="email" value="{{ old('email') }}">
                                        @error('email')
                                            <span class="help-block" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="productname">SDT</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{ old('phone') }}">
                                        @error('phone')
                                            <span class="help-block" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="productname">Địa chỉ</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ" value="{{ old('address') }}">
                                        @error('address')
                                            <span class="help-block" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group @error('price') has-error @enderror">
                                    <div class="col-md-6">
                                        <label for="productname">Mật khẩu</label>
                                        <input type="text" class="form-control" id="password" name="password" placeholder="Mật khẩu" value="{{ old('password') }}">
                                        @error('password')
                                            <span class="help-block" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary mt-2">Thêm mới</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!-- end page content -->
        </div>
            
    </div>
</div>
@endsection
