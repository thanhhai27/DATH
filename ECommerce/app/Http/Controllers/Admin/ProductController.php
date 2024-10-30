<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function add_product(){
        return view('admin.product.add',[
            'title' => 'Thêm Sản Phẩm'
        ]);
    }
    public function insert_product(Request $request){
        $product = new product();
        $product -> category = $request -> input('category');
        $product -> subcategory = $request -> input('subcategory');
        $product -> image = $request -> input('image');
        $product -> name = $request -> input('name');
        $product -> price_sale = $request -> input('price_sale');
        $product -> save();
        return redirect()-> back();
    }
    public function list_product(){
        $product = product::all();
        return view('admin.product.list',[
            'title' => 'Danh sách Sản Phẩm',
            'products' => $product
        ]);
    }

    public function delete_product(Request $request){
        product::find($request -> product_id) -> delete();
    }
    public function edit_product(Request $request){
        $product = product::find($request -> id);
        return view('/admin/product/edit',[
            'title' => 'Sửa Sản Phẩm',
            'product' => $product
        ]);
    }
    public function update_product(Request $request){
        $product = product::find($request -> id);
        $product -> image = $request -> input('image');
        $product -> name = $request -> input('name');
        $product -> price_sale = $request -> input('price_sale');
        $product -> save();
        return redirect('/admin/product/list');
    }
    public function show_admin_info(){
        return view('admin.admin_info',[
            'title'=> 'Thông tin cá nhân'
        ]);
    }

    public function show_main(){
        return view('admin.main',[
            'title'=> 'Trang chủ'
        ]);
    }
}
