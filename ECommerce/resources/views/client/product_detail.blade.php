<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('frontend/asset/css/product_detail.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>Dashboard_Admin</title>
</head>
<body>
    <section class="admin">
        <div class="row-grid">
            <div class="admin-sidebar">
                <div class="admin-sidebar-top">
                    <a href="/"><img src="{{asset('frontend/asset/images/logo.png')}}" alt=""></a>
                </div>
            </div>
            <div class="admin-content">
                <div class="admin-content-top">
                    @include('client/parts/header')
                </div>
            </div>
        </div>
    </section>
    <section class="product-detail">
        <form action="/cart/add" method="post">
        <div class="container">
                <div class="row-flex-product-detail">
                    <p class="heading-text">Sản Phẩm</p><i class="ri-arrow-right-line"></i><p>{{$product -> name}}</p>
                </div>
                <div class="row-grid">
                    <div class="product-detail-left">
                        <img src="{{asset($product -> image)}}" alt="">
                    </div>
                    <div class="product-detail-right">
                        <div class="product-detail-right-infor">
                            <h1>{{$product -> name}}</h1>
                            <span class="product-detail-right-infor-rating">5.0</span>
                            <span>                        
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </span>
                            <div class="product-detail-right-price">
                                <p class="price">{{number_format($product -> price_sale)}}đ</p>
                            </div>
                        </div>
                        <div class="product-detail-right-des">
                            <h2>Thông tin sản phẩm</h2>
                            <ul>
                                <li>Thương hiệu: Tứ Trụ</li>
                                <li>Xuất xứ: Việt Nam</li>
                                <li>Tổ chức chịu trách nhiệm về hàng hóa: Công ty Cổ phần Tứ trụ Việt Nam</li>
                                <li>Địa chỉ: 268 Lý Thường Kiệt, Phường 14, Quận 10, Hồ Chí Minh</li>
                                <li>Khu vực giao hàng: Thành phố Hồ Chí Minh</li>
                                <li>GIAO HÀNG NHANH 30 PHÚT</li>
                            </ul>
                        </div>
                        <div class="product-detail-right-deli">
                            <h2>Vận chuyển</h2>
                            <div class="product-detail-right-deli-info">
                                <img src="{{asset('frontend/asset/images/free-ship.png')}}" alt="">
                                <span>MIỄN PHÍ VẬN CHUYỂN</span>
                            </div>
                        </div>
                        <div class="product-detail-right-quantity">
                            <h2>Số lượng</h2>
                            <div class="product-detail-right-quantity-input">
                                <i class="ri-subtract-line"></i>
                                <input onkeydown="return false" class="quantity-input" name="product_qty" type="number" value="1">
                                <input type="hidden" value="{{$product -> id}}" name="product_id">
                                <i class="ri-add-line"></i>
                            </div>
                        </div>
                        <div class="product-detail-right-addcart">
                            <button type="submit" class="main-btn">Thêm Vào Giỏ Hàng</button>
                        </div>
                    </div>
                </div>
            </div>
            @csrf
        </form>
    </section>
    <footer>
        @include('client/parts/footer')
    </footer>
</body>
</html>