<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminPassResetNotification;
use App\Notifications\Pass;
use DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    function submitForgetPasswordForm(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $users_info = User::where('email',$request->email)->firstOrFail();

        DB::table('password_reset_tokens')->where('email',$users_info->email)->delete();

         $token = Str::random(64);
       $pass_reset_insert =  DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
          ]);

        //   Notification::send($users_info, new AdminPassResetNotification($pass_reset_insert));
        Notification::send($users_info, new Pass($token));
          return back();
    }
    function pass_reset_form($id){
        if(DB::table('password_reset_tokens')->where('token',$id)->get()){
            return view('auth.passwords.password_reset_form',[
                'token'=>$id,
            ]);
        }
        // return view('auth.passwords.password_reset_form');
    }
    function pass_change(Request $request,$id){
        $request->validate([
            'password' => 'required|min:8',
        ]);
        $check = DB::table('password_reset_tokens')->where('token',$id)->first();
        if($check){
         User::where('email',$check->email)->update([
            'password'=>Hash::make($request->password),
         ]);
         return redirect('/login');
        }
    }
}
