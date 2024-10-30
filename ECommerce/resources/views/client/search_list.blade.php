<!DOCTYPE html>
<html lang="en">
<head>
    @include('client.parts.head')
</head>
<body>
    <section class="admin">
        <div class="row-grid">
            <div class="admin-sidebar">
                @include('client/parts/sidebar')
            </div>
            <div class="admin-content">
                <div class="admin-content-top">
                    @include('client/parts/header')
                </div>
                <div class="admin-content-main">
                    <div class="admin-content-main-content">
                        <ul class="admin-content-main-content-products">
                            @if($products->isEmpty())
                                <p class="admin-content-main-content-products-empty">Không tìm thấy sản phẩm nào với từ khóa "{{ $keyword }}"</p>
                            @else
                                @foreach ($products as $product)
                                    <li>
                                        <div class="admin-content-main-content-product-item">
                                            <div class="product-top">
                                                <a href="/client/product_detail/{{$product->id}}" class="product-thumb">
                                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                                </a>
                                            </div>
                                            <div class="product-info">
                                                <a href="/client/product_detail/{{$product->id}}" class="product-name">{{ $product->name }}</a>
                                                <div class="product-price">{{ number_format($product->price_sale) }} VNĐ</div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        @include('client/parts/footer')
    </footer>
</body>
</html>