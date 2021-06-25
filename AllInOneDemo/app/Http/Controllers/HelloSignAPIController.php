<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use HelloSign\Client as SignAPI;
class HelloSignAPIController extends Controller
{
    
    public $hello_sign_api_key;

    public function __construct()
    {   
       
        $this->hello_sign_api_key = env('HELLOSIGN_API_KEY');
      
    }


 public function testAPI(Request $request){

      echo "Hello-Sign API TEST DEMO";

      $client = new SignAPI($this->hello_sign_api_key);
      $account = $client->getAccount();
 
      $response =  $client->getSignatureRequests(1);
     

      $url = "https://api.hellosign.com/v3/account";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          "-u:".$this->hello_sign_api_key,
      ));
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
      $response = curl_exec($ch);
      curl_close($ch);
      $response= json_decode($response, true);

      dd($response);

       return response()->json(["Data"=>$response]);


 }


}
