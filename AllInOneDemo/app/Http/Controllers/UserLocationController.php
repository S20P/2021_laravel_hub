<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserLocationController extends Controller
{
    public function ip_details(Request $request)
    {
       $ip = '2405:205:c90e:ed69:8044:9ad7:3045:e6b7'; //For static IP address get
      //  $ip = $request->ip(); //Dynamic IP address get

        $data = \Location::get($ip);   
        return view('UserLocationDetails',compact('data'));
    }
}
