<?php

namespace App\Http\Controllers\razorpay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RazorpayPayment;
use Redirect,Response;

class PaymentController extends Controller
{
    //It lists Store Items
    public function show_products()
    {
       return view('razorpay.payment');
    }
    
    //To handle payment
    public function pay_success(Request $request){
      
        $data = [
        'user_id' => '1',
        'payment_id' => $request->payment_id,
        'amount' => $request->amount,
        ];
        $getId = RazorpayPayment::insertGetId($data);  
        $arr = array('msg' => 'Payment successful.', 'status' => true);
        return Response()->json($arr);    

    }
    
    //Payment Acknowledgement
    public function thank_you()
    {
         return view('razorpay.thankyou');
    }
}
