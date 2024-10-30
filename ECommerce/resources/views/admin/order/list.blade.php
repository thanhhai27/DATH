@extends('admin.main')
@section('content')
<div class="admin-content-main-content-order-list">
    <div class="admin-content-main-content-order-list-outer">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Điện thoại</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Thông tin bổ sung</th>
                    <th>Hình thức TT</th>
                    <th>Chi tiết</th>
                    <th>Ngày</th>
                    <th>Trạng thái</th>
                    <th>Tùy biến</th>
                </tr>
            </thead>
            <body>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{$order -> id}}</td>
                        <td>{{$order -> name}}</td>
                        <td>{{$order -> phone}}</td>
                        <td>{{$order -> email}}</td>
                        <td>{{$order -> address}}, {{$order -> city}}, {{$order -> district}}, {{$order -> ward}}</td>
                        <td>{{$order -> note}}</td>
                        <td>{{$order -> method}}</td>
                        <td>
                            <a class="edit-class" href="/admin/order/detail/{{$order -> order_detail}}">Chi tiết</a>
                        </td>
                        <td>{{$order -> created_at}}</td>
                        <td>
                            <a class="non-confirm-order" href="">Chưa xác nhận</a>
                        </td>
                        <td>
                            <a class="delete-class">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            </body>
        </table>
    </div>
</div>

@endsection