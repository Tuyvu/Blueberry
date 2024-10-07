@extends('admin.layouts.master')
@section('title','homeadmin')
@section('mainad-content')
<div class="page-wrapper">
  <div class="page-content">
    <div class="container-xxl">
<!-- Page Content-->
        <div class="ibox-content">
      @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
              <strong>{{ $message }}</strong>
      </div>
      @endif
      <div class="row">
          <div class="col-sm-9 m-b-xs">
              <a href="{{route('category.index')}}" class="btn btn-success">back</a>
          </div>
      </div>
      <div class="table-responsive">
          <table class="table table-striped">
              <thead>
              <tr>
  
                  <th>#</th>
                  <th>tên</th>
                  <th>Ngày tạo</th>
                  <th></th>
                  <th></th>
              </tr>
              </thead>
              <tbody>
              @forelse ($categories as $item)
              <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$item->name}}</td>
                  <td>{{$item->created_at}}</td>
                  <td><a href="{{Route('category.restore_id',$item->id)}}" class="btn btn-success">khôi phục</a></td>
                  <td><a href="{{Route('category.foredelete',$item->id)}}" onclick="return comfirm('có muốn xóa')" class="btn btn-danger">xóa</a></td>
                  
              </tr>
              @empty
              <tr>
                  <span>chưa có dữ liệu</span>
              </tr>
              @endforelse
              </tbody>
          </table>
      </div>
  
  </div> 
        <!-- end page content -->
    </div>
</div>
    <!-- Page Content-->
     <!-- end page content -->
</div>
@endsection