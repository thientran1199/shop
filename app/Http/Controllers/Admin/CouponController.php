<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu_active = 4;
        $coupons = Coupon::all();
        return view('admin.coupon.index',compact('menu_active','coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu_active=4;
        return view('admin.coupon.create',compact('menu_active'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'coupon_code'=>'required|min:5|max:15|unique:coupons,coupon_code',
            'amount'=>'required|numeric|between:1,99',
            'expiry_date'=>'required|date'
        ]);
        $input_data=$request->all();
        if(empty($input_data['status'])){
            $input_data['status']=0;
        }
        Coupon::create($input_data);
        return back()->with('message','Add Coupon Already');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu_active=4;
        $edit_coupons=Coupon::findOrFail($id);
        return view('admin.coupon.edit',compact('menu_active','edit_coupons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update_coupon=Coupon::findOrFail($id);
        $this->validate($request,[
            'coupon_code'=>'required|min:5|max:15|unique:coupons,coupon_code,'.$update_coupon->id,
            'amount'=>'required|numeric|between:1,99',
            'expiry_date'=>'required|date'
        ]);
        $input_data=$request->all();
        if(empty($input_data['status'])){
            $input_data['status']=0;
        }
        $update_coupon->update($input_data);
        return redirect()->route('coupon.index')->with('message','Edit Coupon Already!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_coupon=Coupon::findOrFail($id);
        $delete_coupon->delete();
        return back()->with('message','Delete Coupon Already!');
    }
    public function applycoupon(Request $request){
        $this->validate($request,[
            'coupon_code'=>'required'
        ]);
        $input_data=$request->all();
        $coupon_code=$input_data['coupon_code'];
        $total_amount_price=$input_data['Total_amountPrice'];
        $check_coupon=Coupon::where('coupon_code',$coupon_code)->count();
        if($check_coupon==0){
            return back()->with('message_coupon','Your Coupon Code Not Exist!');
        }else if($check_coupon==1){
            $check_status=Coupon::where('status',1)->first();
            if($check_status->status==0){
                return back()->with('message_coupon','Your Coupon was Disabled!');
            }else{
                $expiried_date=$check_status->expiry_date;
                $date_now=date('Y-m-d');
                if($expiried_date<$date_now){
                    return back()->with('message_coupon','Your Coupon was Expired!');
                }else{
                    $discount_amount_price=($total_amount_price*$check_status->amount)/100;
                    Session::put('discount_amount_price',$discount_amount_price);
                    Session::put('coupon_code',$check_status->coupon_code);
                    return back()->with('message_apply_sucess','Your Coupon Code was Apply');
                }
            }
        }
    }

}
