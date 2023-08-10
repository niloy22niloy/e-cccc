<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    //
    function admins_info(){
          $user_list =  User::all();
          return view('admin.user_list',[
            'user_list'=>$user_list,
          ]);
    }
    function delete_user(Request $request){

        User::find($request->up_id)->delete();
        return response()->json([
            'status'=>'success',
          ]);


    }
    function admin_edit($id){
      $users_info = User::find($id);
        return view('admin.admin_edit',[
            'users_info'=>$users_info,
        ]);
    }
    function admin_edit_confirm(Request $request, $id){

        $user = User::find($id);
        // Update the item with the new data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        if ($user->wasChanged()) {
            // The item was updated
            return back()->with('success',"Edited Successfully");
        } else {
            // The item was not updated
            return back()->with('fail',"Not Edited");
        }

    }
}
