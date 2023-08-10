<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\CustomerEmailVerify;
use App\Models\GuestLogin;
use App\Notifications\customeremailverifynotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RegisterLoginController extends Controller
{
    //
    function register_login(){
        $carts = CartModel::where('customer_id',Auth::guard('guestlogin')->id())->get();
        return view('Frontend.Register\Login.register_login',[
            'carts'=>$carts,
        ]);
    }
    function guest_register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:guest_logins,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        
        $guestLogin = GuestLogin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        
        $customer = GuestLogin::where('email', $request->email)->firstOrFail();
        
        $customer_info = CustomerEmailVerify::create([
            'customer_id' => $customer->id,
            'token' => uniqid(),
        ]);
        
        // Sending the notification to the customer
        $customer->notify(new CustomerEmailVerifyNotification($customer_info));
        
        return back()->with('success', "We Have Sent You An Email. Please check your inbox to verify your email address.");



        
        // if ($guestLogin) {
        //     Auth::guard('guestlogin')->login($guestLogin);
        //     return redirect()->route('kumo.homepage')->with('success', 'Successfully registered and logged in.');
        // } else {
        //     return redirect()->route('register.login');
        // }
        
        



        
        
    }
    function customer_email_verify($token){
     $customer = CustomerEmailVerify::where('token',$token)->firstOrFail();
       GuestLogin::find($customer->customer_id)->update([
        'email_verified_at' => now()->format('Y-m-d'),
     ]);
     $guestLogin = GuestLogin::where('id',$customer->customer_id)->where('email_verified_at','!=',null)->first();
     
        if ($guestLogin) {
            Auth::guard('guestlogin')->login($guestLogin);
            $customer->delete();
            return redirect()->route('kumo.homepage')->with('success', 'Email Verified And Successfully registered and logged in.');
        } else {
            return redirect()->route('register.login');
        }
    

    }
    function guest_login(Request $request){
        $guestLogin = GuestLogin::where('email',$request->email)->first();
        if($guestLogin->email_verified_at == null){
            return back()->with('success','Please First Verify The Email');
        }
       else{
            if(Auth::guard('guestlogin')->attempt([
                'email'=>$request->email,
                'password'=>$request->password,
            ])){
                return redirect()->route('kumo.homepage')->with('success','Successfully Login');
            }else{
                return redirect()->route('register.login');
            }
        }
        

    
    }
    function guest_logout(){
        Session::flush();
        
        Auth::guard('guestlogin')->logout();

        return redirect()->route('kumo.homepage')->with('success','Successfully Logout');;
    }
}
