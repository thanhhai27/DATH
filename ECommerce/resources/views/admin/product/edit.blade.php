@extends('admin.main')
@section('content')
<form action="" enctype="multipart/form-data" method="post">
<div class="admin-content-main-content-product-add">
    <div class="admin-content-main-content-input">
        <input type="text" value="{{$product -> category}}" name="category" placeholder="Loại sản phẩm">
        <input type="text" value="{{$product -> subcategory}}" name="subcategory" placeholder="Nhánh sản phẩm">
    </div>
    <div class="admin-content-main-content-input">
        <input type="text" value="{{$product -> name}}" name="name" placeholder="Tên sản phẩm">
        <input type="text" value="{{$product -> price_sale}}"  name="price_sale" placeholder="Giá bán">
    </div>
    <div class="admin-content-main-content-image">
        <label for="file">Ảnh Sản Phẩm</label>
        <input id="file" type="file">
        <input type="hidden" name="image" value="{{$product -> image}}" id="input-file-img-hiden">
        <div class="image-show" id="input-file-img">
            <img src="{{$product -> image}}" alt="">
        </div>
    </div>
    <button type="submit" class="main-btn">Cập nhật Sản Phẩm</button>
</div>
@csrf
</form>
@endsection
@section('footer')
<script src="{{asset('backend/asset/js/product_ajax.js')}}"></script>
@endsection