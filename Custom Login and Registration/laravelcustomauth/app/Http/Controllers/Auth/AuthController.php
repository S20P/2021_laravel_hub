<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;

class AuthController extends Controller
{
    
    public function login()
    {
      return view('auth.login');
    }

    public function authenticate(Request $request)
    {

        $log_email = "test@gmail.com";
        $log_password = 123456;

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $email=$request->email;
        $pass=$request->password;


        if($log_email==$email && $log_password==$pass){

            //now we have to store the data to the session

            $request->session()->put('user_email',$email);
           

            return redirect('/home');

        }else{

                return redirect('/login')->with('error','Email or Password does not match');
        }

        return redirect('login')->with('error', 'Oppes! You have entered invalid credentials');
    }

    public function logout(Request $request) {

        $request->session()->forget('user_email');
       
        return redirect('/login');

    }

    public function home(Request $request)
    {
        if($request->session()->get('user_email')=="")
        {
           return redirect('/login');

        }else{

        $user_email=$request->session()->get('user_email');

        $log_user = array('user_email' => $user_email);

        return view('home')->with($log_user);

            }
  
    }



}
