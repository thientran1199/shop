<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function index(){
        return view('users.login_register');
    }
    public function register(Request $request){
        $this->validate($request,[
            'name'=>'required|string|max:255',
             'email'=>'required|string|email|unique:users,email',
             'password'=>'required|min:6|confirmed',

         ]);
         $input_data = $request->all();
         $input_data['password'] = Hash::make($input_data['password']);
         User::create($input_data);
         return back()->with('message','Registered already!');
    }
    public function login(Request $request){
        $input_data = $request->all();
        if(Auth::attempt(['email' => $input_data['email'],'password'=>$input_data['password'],'admin' =>'1'])){
            Session::put('frontSession' , $input_data['email']);
            return redirect('admin');
        }else if(Auth::attempt(['email' => $input_data['email'],'password'=>$input_data['password']])){
            Session::put('frontSession' , $input_data['email']);
            return redirect('/');
         }

    }
    public function logout(){
        Auth::logout();
        Session::forget('frontSession');
        return redirect('/');

    }
    public function account(){
        $user_login = User::where('id', Auth::id())->first();
        return view('users.account',compact('user_login'));
    }

    public function updatepassword(Request $request,$id){
        $oldPassword = User::where('id',$id)->first();
        $input_data = $request->all();
        if(Hash::check($input_data['password'] , $oldPassword->password)){
            $this->validate($request,[
               'newPassword'=>'required|min:6|max:12|confirmed'
            ]);
            $new_pass = Hash::make($input_data['newPassword']);
            User::where('id', $id)->update(['password' => $new_pass]);
            return back()->with('message' , 'Cập Nhật mật khẩu thành công');
        }else{
            return back()->with('oldpassword' , 'Old Password is Inconrrect!');
        }
    }
}
