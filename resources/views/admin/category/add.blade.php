@extends('admin.layouts.master')
@section('title','homeadmin')
@section('mainad-content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="container-xxl">
    <!-- Page Content-->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thêm mới menu</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{route('category.store')}}">
                    @csrf
                    <div class="box-body">
                    <div class="form-group @error('name') has-error @enderror">
                        <label for="exampleInputEmail1">Tên Menu</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="tên">
                        @error('name')
                            <span class="help-block">{{$message}}</span>
                        @enderror
                    </div>
                    
                    </div>
                    <!-- /.box-body -->
            
                    <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
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