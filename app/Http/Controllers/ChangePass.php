<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Hash;
use App\Models\User;
use Auth;

class ChangePass extends Controller
{
    //

    public function CPassword()
    {
        return view('admin.body.Change_Password');
    }

    public function UpdatePassword(Request $request)
    {

       

        $hashpassword = Auth::user()->password;
        if(Hash::check($request->oldpassword,$hashpassword))
        {
            $user = User::find(Auth::id()); 
            $user->password =Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success','Password changed Successfully');

        }
        else
        {
            return redirect()->back()->with('error','Current Password is Invalid');
        }


    }

public function PUpdate()
{
    if(Auth::user())
    {

        $user = User::find(Auth::id()); 

        if($user)
        {
            return view('admin.body.update_profile',compact('user'));
        }

    }
}

    public function UpdateProfile(Request $request)
    {

        $user = User::find(Auth::user()->id);

        if($user)
        {
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->save();

            return redirect()->back()->with('success','Profile Updated Successfully !');
        }
        else
        {
            return redirect()->back();
        }

    }

}
