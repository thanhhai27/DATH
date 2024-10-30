<?php

namespace App\Http\Controllers;

use App\Mail\AdminMail;
use App\Models\order;
use App\Models\product;
use App\Notifications\EmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isNull;

class FrontendController extends Controller
{
    public function index() {
        $products = product::where('category', 'FOOD')
                           ->where(function($query) {
                               $query->where('subcategory', 'FOOD1')
                                     ->orWhere('subcategory', 'FOOD2');
                           })->get();
    
        return view('client.list.food', [
            'products' => $products
        ]);
    }
    public function drink_index() {
        $products = product::where('category', 'DRINK')
                           ->where(function($query) {
                               $query->where('subcategory', 'DRINK1')
                                     ->orWhere('subcategory', 'DRINK2')
                                     ->orWhere('subcategory', 'DRINK3');
                           })->get();
    
        return view('client.list.drink', [
            'products' => $products
        ]);
    }
    public function vefr_index() {
        $products = product::where('category', 'VEFR')
                           ->where(function($query) {
                               $query->where('subcategory', 'VEFR1')
                                     ->orWhere('subcategory', 'VEFR2');
                           })->get();
    
        return view('client.list.fruit', [
            'products' => $products
        ]);
    }
    public function frozen_index() {
        $products = product::where('category', 'FROZEN')
                           ->where(function($query) {
                               $query->where('subcategory', 'FROZEN1')
                                     ->orWhere('subcategory', 'FROZEN2')
                                     ->orWhere('subcategory', 'FROZEN3');
                           })->get();
    
        return view('client.list.frozen', [
            'products' => $products
        ]);
    }
    public function snack_index() {
        $products = product::where('category', 'SNACK')
                           ->where(function($query) {
                               $query->where('subcategory', 'SNACK1')
                                     ->orWhere('subcategory', 'SNACK2')
                                     ->orWhere('subcategory', 'SNACK3');
                           })->get();
    
        return view('client.list.snack', [
            'products' => $products
        ]);
    }
    public function condiment_index() {
        $products = product::where('category', 'CONDIMENT')
                           ->where(function($query) {
                               $query->where('subcategory', 'CONDIMENT1')
                                     ->orWhere('subcategory', 'CONDIMENT2')
                                     ->orWhere('subcategory', 'CONDIMENT3')
                                     ->orWhere('subcategory', 'CONDIMENT4')
                                     ->orWhere('subcategory', 'CONDIMENT5');
                           })->get();
    
        return view('client.list.condiment', [
            'products' => $products
        ]);
    }
    public function percare_index() {
        $products = product::where('category', 'PERCARE')
                           ->where(function($query) {
                               $query->where('subcategory', 'PERCARE1')
                                    ->orWhere('subcategory', 'PERCARE2')
                                    ->orWhere('subcategory','PERCARE3')
                                    ->orWhere('subcategory','PERCARE4');
                           })->get();
    
        return view('client.list.person_care', [
            'products' => $products
        ]);
    }
    public function houcare_index() {
        $products = product::where('category', 'HOUCARE')
                           ->where(function($query) {
                               $query->where('subcategory', 'HOUSECARE1')
                                    ->orWhere('subcategory', 'HOUSECARE2');
                           })->get();
    
        return view('client.list.house_care', [
            'products' => $products
        ]);
    }
    public function elect_index() {
        $products = product::where('category', 'ELECT')
                           ->where(function($query) {
                               $query->where('subcategory', 'ELECT1')
                                    ->orWhere('subcategory', 'ELECT2');
                           })->get();
    
        return view('client.list.electric', [
            'products' => $products
        ]);
    }

    
    public function show_product(Request $request){
        $products = product::find($request -> id);
        return view('client.product_detail',[
            'product' => $products
        ]);
    }
    public function add_cart(Request $request){
        $product_id = $request -> product_id;
        $product_qty = $request -> product_qty;
        if(is_null(Session::get('cart'))){
            Session::put('cart',[
                $product_id => $product_qty
            ]);
            return redirect('/client/cart');
        }
        else{
            $cart = Session::get('cart');
            if(Arr::exists($cart,$product_id)){
                $cart[$product_id] += $product_qty;
                Session::put('cart',$cart);
                return redirect('/client/cart');
            }
            else{
                $cart[$product_id] = $product_qty;
                Session::put('cart',$cart);
                return redirect('/client/cart');
            }
        }
    }
    public function show_cart(){
        $cart = Session::get('cart');
        $product_id = array_keys($cart);
        $products = product::whereIn('id',$product_id) -> get();
        return view('client.cart',[
            'products' => $products
        ]);
    }

    public function delete_cart(Request $request){
        $cart = Session::get('cart');
        $product_id = $request -> id;
        unset($cart[$product_id]);
        Session::put('cart',$cart);
        return redirect('/client/cart');
    }
    public function update_cart(Request $request){
        $cart = $request -> product_id;
        Session::put('cart',$cart);
        return redirect('/client/cart');
    }

    public function send_cart(Request $request){
        $token = Str::random(13);
        $order = new order;
        $order -> name = $request -> input('name');
        $order -> phone = $request -> input('phone');
        $order -> email = $request -> input('email');
        $order -> city = $request -> input('city');
        $order -> district = $request -> input('district');
        $order -> ward = $request -> input('ward');
        $order -> address = $request -> input('address');
        $order -> note = $request -> input('note');
        $order -> method = $request -> input('method');
        $order_detail = json_encode($request -> input('product_id'));
        $order -> order_detail = $order_detail;
        $order -> token = $token;
        $order -> save();
        Session::flush('cart');
        $mailInfor = $order -> email;
        $nameInfor = $order -> name;
        $Mail = Mail::to($mailInfor) -> send(new AdminMail($nameInfor));
        Notification::send($order, new EmailNotification($order));
        return redirect('/client/order_confirm');
    }
    public function show_client_info(){
        return view('client.client_info');
    }
    
    public function search_list_index(Request $request){
        $keyword = $request->input('keyword');
        
        // Tìm sản phẩm dựa trên từ khóa trong name hoặc price_sale
        $products = Product::where('name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('price_sale', 'LIKE', '%' . $keyword . '%')
                        ->get();

        // Trả về view cùng với kết quả tìm kiếm
        return view('client.search_list', compact('products', 'keyword'));
    }
}
