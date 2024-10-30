@extends('admin.main')
@section('content')
<form action="/admin/product/add" enctype="multipart/form-data" method="post">
<div class="admin-content-main-content-product-add">
    <div class="admin-content-main-content-input">
        <input type="text" value="{{old('category')}}" name="category" placeholder="Loại sản phẩm">
        <input type="text" value="{{old('subcategory')}}" name="subcategory" placeholder="Nhánh sản phẩm">
    </div>
    <div class="admin-content-main-content-input">
        <input type="text" value="{{old('name')}}" name="name" placeholder="Tên sản phẩm">
        <input type="text" value="{{old('price_sale')}}"  name="price_sale" placeholder="Giá bán">
    </div>
    <div class="admin-content-main-content-image">
        <label for="file">Ảnh Sản Phẩm</label>
        <input id="file" type="file">
        <input type="hidden" name="image" id="input-file-img-hiden">
        <div class="image-show" id="input-file-img">
            
        </div>
    </div>
    <button type="submit" class="main-btn">Thêm Sản Phẩm</button>
</div>
@csrf
</form>
@endsection
@section('footer')
<script src="{{asset('backend/asset/js/product_ajax.js')}}"></script>
@endsection