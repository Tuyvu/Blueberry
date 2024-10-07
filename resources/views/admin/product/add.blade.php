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
                        <a href="{{route('product.index')}}" class="btn btn-success">back</a>
                    </div>
                </div>
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm mới sản phẩm</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group @error('name') has-error @enderror">
                                    <div class="col-md-6">
                                        <label for="productname">Tên sản phẩm</label>
                                        <input type="text" class="form-control" id="productname" name="name" placeholder="tên sản phẩm" onkeyup="ChangeToSlug()" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="help-block" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="slug">Đường dẫn</label>
                                        <input type="text" class="form-control" id="slug" name="slug" placeholder="đường dẫn" value="{{ old('slug') }}">
                                        @error('slug')
                                            <span class="help-block" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group @error('price') has-error @enderror">
                                    <div class="col-md-6">
                                        <label for="price">Giá sản phẩm</label>
                                        <input type="text" class="form-control" id="price" name="price" placeholder="giá sản phẩm" value="{{ old('price') }}">
                                        @error('price')
                                            <span class="help-block" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="sale_price">Giá khuyến mại</label>
                                        <input type="text" class="form-control" id="sale_price" name="sale_price" placeholder="giá khuyến mại" value="{{ old('sale_price') }}">
                                        @error('sale_price')
                                            <span class="help-block" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="discount">Số lượng</label>
                                        <input type="text" class="form-control" id="discount" name="discount" placeholder="số lượng" value="{{ old('discount') }}">
                                        @error('discount')
                                            <span class="help-block" style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="category_id">Chọn danh mục</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" {{ old('category_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group @error('photo') has-error @enderror">
                                <label for="photo">Ảnh sản phẩm</label>
                                <input type="file" class="form-control" id="photo" name="photo">
                                <img id="photo-preview" src="#" alt="Preview" style="display: none; max-width: 200px; margin-top: 10px;"/>
                                @error('photo')
                                    <span class="help-block" style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group @error('photos') has-error @enderror">
                                <label for="photos">Ảnh chi tiết sản phẩm</label>
                                <input type="file" class="form-control" id="photos" name="photos[]" multiple>
                                <div id="photos-preview" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;"></div>
                                @error('photos')
                                    <span class="help-block" style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            

                            <div class="form-group @error('description') has-error @enderror">
                                <label for="editor">Mô tả sản phẩm</label>
                                <textarea class="form-control" name="description" id="editor">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="help-block" style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="stock">Sản phẩm nổi bật</label>
                                <input type="checkbox" value="1" name="stock" {{ old('stock') ? 'checked' : '' }}>
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
        <script language="javascript">
          function ChangeToSlug()
          {
              var productname, slug;
        
              //Lấy text từ thẻ input title 
              productname = document.getElementById("productname").value;
              // console.log(productname);
              //Đổi chữ hoa thành chữ thường
              slug = productname.toLowerCase();
        
              //Đổi ký tự có dấu thành không dấu
              slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
              slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
              slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
              slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
              slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
              slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
              slug = slug.replace(/đ/gi, 'd');
              //Xóa các ký tự đặt biệt
              slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
              //Đổi khoảng trắng thành ký tự gạch ngang
              slug = slug.replace(/ /gi, "-");
              //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
              //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
              slug = slug.replace(/\-\-\-\-\-/gi, '-');
              slug = slug.replace(/\-\-\-\-/gi, '-');
              slug = slug.replace(/\-\-\-/gi, '-');
              slug = slug.replace(/\-\-/gi, '-');
              //Xóa các ký tự gạch ngang ở đầu và cuối
              slug = '@' + slug + '@';
              slug = slug.replace(/\@\-|\-\@|\@/gi, '');
              //In slug ra textbox có id “slug”
              document.getElementById('slug').value = slug;
          }
        </script>
        <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
        <script>
        ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .then( editor => {
                        console.log( editor );
                } )
                .catch( error => {
                        console.error( error );
                } );
        </script>
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
            
            document.getElementById('photos').addEventListener('change', function(event) {
                const files = event.target.files;
                const previewContainer = document.getElementById('photos-preview');
                previewContainer.innerHTML = ''; // Clear existing previews
            
                if (files) {
                    Array.from(files).forEach(file => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const imgElement = document.createElement('img');
                            imgElement.src = e.target.result;
                            imgElement.style.maxWidth = '100px';
                            imgElement.style.margin = '5px';
                            previewContainer.appendChild(imgElement);
                        };
                        reader.readAsDataURL(file);
                    });
                }
            });
            </script>
            
    </div>
</div>
@endsection
