@extends('admin.main')
@section('content')
<div class="admin-content-main-content-product-list">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá bán</th>
                <th>Ngày đăng</th>
                <th>Tùy chỉnh</th>
            </tr>
        </thead>
        <body>
            @foreach ($products as $product)
                <tr>
                    <td>{{$product -> id}}</td>
                    <td><img style="width: 70px;" src="{{asset($product -> image)}}" alt=""></td>
                    <td>{{$product -> name}}</td>
                    <td>{{number_format($product -> price_sale)}}</td>
                    <td>{{$product -> created_at}}</td>
                    <td>
                        <a href="/admin/product/edit/{{$product -> id}}" class="edit-class" href="">Sửa</a>
                        |
                        <a onclick="removeRow(product_id=<?php echo $product -> id?>,url='/admin/product/delete')" class="delete-class" href="">Xóa</a>
                    </td>
                </tr>
            @endforeach
        </body>
    </table>
</div>
@endsection
@section('footer')
    <script>
    function removeRow(product_id,url){
        if(confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')){
                $.ajax({
                url: url,
                data: {product_id},
                method: 'GET',
                dataType:'JSON',
                success: function (res){
                console.log(res)
                }
            }
            )
        }
        }
    </script>
@endsection