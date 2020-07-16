<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Customer;
use App\Helper\CartHelper;
use App\Models\Order_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckOutController extends Controller
{
    public function index(){
        return view('checkout.index');
    }
    public function submitCheckout(Request $request  ){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ],[
            'name.required' => 'vui long nhap ho ten',
            'email.required' => 'vui long nhap lai',
            'email.email' => 'email ko dung',
            'address.required' => 'vui long nhap dia chi',
            'phone.required' => 'vui long nhap sdt',
        ]);
        // $input_data = $request->all();

        $cus = new Customer();
        $cus->name = $request->name;
        $cus->email = $request->email;
        $cus->phone = $request->phone;
        $cus->address = $request->address;
        $cus->save();

        // $carts  = Cart::content();
        $orders = new Order();
        $orders->id = $request->id;
        $orders->customer_id = $cus->id;
        $orders->email = $request->email;
        $orders->phone = $request->phone;
        $orders->address = $request->address;
        $orders->save();

        $cart_datas = session()->get('carts');


        foreach ($cart_datas as $cart_data){
            $quantity = $cart_data['quantity'];
            $products_id = $cart_data['products_id'];
            $order_id = $orders->id;
            $price= $cart_data['price'] * $cart_data['quantity'];
            Order_detail::create([
                'order_id' => $order_id,
                'product_id' => $products_id,
                'price' => $price,
                'quantity' => $quantity

        ]);
        }

        session(['carts'=> '']);

       return view('payment.cod');
    }
}
