<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\CartHelper;
use App\Models\Product;

class CartController extends Controller
{

    public function index(){
        $cart_datas = session()->get('carts');
        $total_price = 0;

            foreach ($cart_datas as $cart_data){
                $total_price += $cart_data['price'] * $cart_data['quantity'];
            }
            return view('frontEnd.cart',compact('cart_datas','total_price'));

    }
    public function addToCart(Request $request ){
        $carts = session()->get('carts');
        $products_id = $request->get('products_id');
        // if cart is empty then this the first product
        if(!$carts) {
            $carts = array(
                $products_id => $request->only('products_id',
                                                'product_name', 'product_code', 'product_color',
                                                'price', 'quantity'));
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($carts[$products_id])) {
            $carts[$products_id]['quantity'] = $carts[$products_id]['quantity'] + 1;
        }else{
            $carts[$products_id] = $request->only('products_id',
            'product_name', 'product_code', 'product_color',
            'price', 'quantity');
        }

        session()->put('carts', $carts);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function deleteItem($products_id = null){
        $carts = session()->get('carts');
        unset( $carts[$products_id]);
        session()->put('carts', $carts);
        return back()->with('message','Deleted Success!');
    }

    public function updateQuantity($products_id, $action){
        $carts = session()->get('carts');
        if(isset($carts[$products_id])){
            if($action == 'asc')
                $carts[$products_id]['quantity'] = $carts[$products_id]['quantity'] + 1;
            if($action == 'desc')
                $carts[$products_id]['quantity'] = $carts[$products_id]['quantity'] - 1;
        }
        session()->put('carts', $carts);
        return back()->with('message','Update quantity Success!');
    }
}
