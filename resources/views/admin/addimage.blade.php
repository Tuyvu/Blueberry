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
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="box-header with-border">
                        <h3 class="box-title">Cập nhật ảnh</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ route('admin.postuploadimage') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            
                            <div class="form-group @error('photo') has-error @enderror">
                                <label for="photo">Ảnh cửa hàng</label>
                                <input type="file" class="form-control" id="photo" name="photo">
                                <img id="photo-preview" src="#" alt="Preview" style="display: none; max-width: 200px; margin-top: 10px;"/>
                                @if (session('error'))
                                    <span class="help-block" style="color: red;"> {{ session('error') }}</span>
                                @endif
                            </div>
                            
                            
                        <!-- /.box-body -->

                        <div class="box-footer" style="margin-top: 10px;">
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!-- end page content -->
        </div>
        <script>
            document.getElementById('photo').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgElement = document.getElementById('photo-preview');
                        imgElement.src = e.target.result;
                        imgElement.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
            </script>
    </div>
</div>
@endsection
