<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\product;
use Illuminate\Http\Request;

class orderController extends Controller
{
    public function list_order(){
        $orders = order::all();
        return view('admin.order.list',[
            'title' => 'Danh sách hóa đơn',
            'orders' => $orders
        ]);
    }
    public function detail_order(Request $request){
        $order_detail = json_decode($request -> order_detail,true);
        $product_id = array_keys($order_detail);
        $products = product::whereIn('id',$product_id) -> get();
        return view('admin.order.detail',[
            'title' => 'Chi tiết sản phẩm',
            'products' => $products,
            'order_detail' => $order_detail
        ]);
    }
}
