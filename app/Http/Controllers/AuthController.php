<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
class AuthController extends Controller
{
    //
    public function methodLogin(Request $request)
    {
        $this->validate($request,
        [
            'email'                     =>      'required|email|min:3|max:100',
            'password'                  =>      'required|min:3|max:100',
        ],
        [
            'email.required'            =>      'You must enter email',
            'email.min'                 =>      'Email must between 3 and 100 characters',
            'email.max'                 =>      'Email must between 3 and 100 characters',
            'email.email'               =>      'You must enter correct email format',
            'password.required'         =>      'You must enter password',
            'password.min'              =>      'Password must between 3 and 100 characters',
            'password.max'              =>      'Password must between 3 and 100 characters',
        ]);
        $email      =   $request->email;
        $password   =   $request->password;
        if(Auth::attempt(['email'=>$email,'password'=>$password]))
        {
            if(Auth::user()->level==1)
            {
                return redirect()->route('home');
            }
            else
            {
                return redirect()->route('login_form')->with('message','Only Admin can access admin form');
            }
        }
        else{
            return redirect()->route('login_form')->with('message','Wrong Email or Password');
        }
    }
    public function createLogin()
    {
        return view('admin.pages.login');
    }
    public function methodLogOut()
    {
        Auth::logout();
        return redirect()->route('login_form')->with('message','Logout Successfull');
    }
}
