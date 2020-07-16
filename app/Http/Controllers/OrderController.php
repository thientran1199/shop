<?php


namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index(){
        $session_id = Session::get('session_id');
        $cart_datas = Cart::where('session_id',$session_id)->get();
        $total_price = 0;
        foreach ($cart_datas as $cart_data){
            $total_price += $cart_data-> price*$cart_data -> quantity;
        }
        $customers = DB::table('customers')->where('id',Auth::id())->first();
        return view('checkout.review_order',compact('customers','cart_datas','total_price'));
    }
    public function order(Request $request){
        $orders = $request->all();
            return redirect('/cod')->compact($orders, 'input_data');

    }
    public function cod(){
         $orders = Order::all();
        return view('payment.cod',compact('orders'));
    }
    
}
