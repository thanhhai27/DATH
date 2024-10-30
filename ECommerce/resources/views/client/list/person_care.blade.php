@extends('client.main')
@section('content')
    <form action="/cart/add" method="post">
        <div class="admin-content-main-content">
            @php
                $groupedProducts = $products->groupBy('subcategory');
            @endphp

            @foreach ($groupedProducts as $subcategory => $items)
                <div class="admin-content-main-content-headline">
                    <h3>
                    @if ($subcategory === 'PERCARE1')
                        Dầu Gội
                    @elseif ($subcategory === 'PERCARE2')
                        Dầu Xã
                    @elseif ($subcategory === 'PERCARE3')
                        Bàn Chải Đánh Răng
                    @elseif ($subcategory === 'PERCARE4')
                        Kem Đánh Răng
                    @endif
                    </h3>
                </div>
                <ul class="admin-content-main-content-products">
                    @foreach ($items as $product)
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
                </ul>
            @endforeach
        </div>
    </form>
@endsection