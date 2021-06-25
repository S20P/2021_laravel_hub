<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\ZohoContacts;

class ZohoController extends Controller
{

    public $clientId,$clientSecret,$redirect_uri,$app_url;

    public function __construct()
    {   
       
        $this->clientId = env('ZOHO_CLIENT_ID');
        $this->clientSecret = env('ZOHO_CLIENT_SECRET');      
        $this->redirect_uri = env('ZOHO_REDIRECT_URI');
        $this->app_url=env('ZOHO_API_DOMAIN');
    }


    public function zohoAuth(Request $request)
    {
        $uri = route('zohocrm');
        $scope =  'ZohoInvoice.contacts.Create';
        $accestype = 'offline';

        $redirectTo = 'https://accounts.zoho.com/oauth/v2/auth' . '?' . http_build_query(
        [
        'client_id' => $this->clientId,
        'redirect_uri' => $this->redirect_uri,
        'scope' => 'ZohoCRM.modules.ALL,ZohoCRM.settings.ALL,ZohoCRM.modules.READ,ZohoCRM.modules.leads.ALL,ZohoCRM.users.ALL',
        'response_type' => 'code',
        ]);

        \Session()->put('zoho_contact_id', $request->id);

        return redirect($redirectTo);
    }


    public function storeZohoContacts(Request $request)
    {
        $input = $request->all();
        $contact_id = \Session::get('zoho_contact_id');
        $client_id = $this->clientId;
        $client_secret = $this->clientSecret;
        \Session::forget('zoho_contact_id');
   
        // Get ZohoCRM Token
        $tokenUrl = 'https://accounts.zoho.com/oauth/v2/token?code='.$input["code"].'&client_id='.$client_id.'&client_secret='.$client_secret.'&redirect_uri='.route('zohocrm').'&grant_type=authorization_code';
        
        $tokenData = [

        ];

        $curl = curl_init();     
        curl_setopt($curl, CURLOPT_VERBOSE, 0);     
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);     
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);     
        curl_setopt($curl, CURLOPT_TIMEOUT, 300);   
        curl_setopt($curl, CURLOPT_POST, TRUE);//Regular post  
        curl_setopt($curl, CURLOPT_URL, $tokenUrl);     
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);     
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($tokenData));

        $tResult = curl_exec($curl);
        curl_close($curl);
        $tokenResult = json_decode($tResult);
         
        if(isset($tokenResult->access_token) && $tokenResult->access_token != '') {
          
          $url = $this->app_url."/crm/v2/Accounts";
          $access_token = $tokenResult->access_token;

            // $response = Http::withHeaders([
            //     'accept' => 'application/json',
            //     "Authorization" =>"Zoho-oauthtoken ".$access_token,
            //     "X-com-zoho-invoice-organizationid" => "688931512"
            // ])->get($url);

            // $response=json_decode($response,true);
          

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'accept:application/json',
                "Authorization:Zoho-oauthtoken ".$access_token,
                "X-com-zoho-invoice-organizationid:688931512"
            ));
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
            $response = curl_exec($ch);
            curl_close($ch);
            $response= json_decode($response, true);
                 
          
            if(isset($response) && isset($response['data']) && count($response['data'])>0){

                   $records = $response['data'];

                   foreach ($records as $row) {

                    $account_id = $row['id'];
                    $owner = $row['Owner'];
                    $created_by = $row['Created_By'];
                    $modified_by = $row['Modified_By'];
                   

                    $last_activity_time = date("Y-m-d H:i:s", strtotime($row['Last_Activity_Time']));
                    $created_time = date("Y-m-d H:i:s", strtotime($row['Created_Time']));
                    $modified_time = date("Y-m-d H:i:s", strtotime($row['Modified_Time']));

                    
                    $process_flow = 1; //0 = false and 1 = true
                    if($row['$process_flow']==false){
                        $process_flow = 0;
                    }

                    $review_process = $row['$review_process'];
                    
                    $review_process_approve = 1; //0 = false and 1 = true
                    if($review_process['approve']==false){
                        $review_process_approve = 0;
                    }
                    $review_process_reject = 1; //0 = false and 1 = true
                    if($review_process['reject']==false){
                        $review_process_reject = 0;
                    }

                    $review_process_resubmit = 1; //0 = false and 1 = true
                    if($review_process['resubmit']==false){
                        $review_process_resubmit = 0;
                    }

                    $editable = 1; //0 = false and 1 = true
                    if($row['$editable']==false){
                        $editable = 0;
                    }

                    $in_merge = 1; //0 = false and 1 = true
                    if($row['$in_merge']==false){
                        $in_merge = 0;
                    }

                    $account_approved = 1; //0 = false and 1 = true
                    if($row['$approved']==false){
                        $account_approved = 0;
                    }

                    $orchestration = 1; //0 = false and 1 = true
                    if($row['$orchestration']==false){
                        $orchestration = 0;
                    }
                  
                 
                                $ZohoContacts = ZohoContacts::firstOrNew(array('account_id' => $account_id));
                                $ZohoContacts->owner_id = $owner['id'];
                                $ZohoContacts->owner_name = $owner['name'];
                                $ZohoContacts->owner_email = $owner['email'];
                               // $ZohoContacts->ownership = $row['Ownership'];
                                $ZohoContacts->email = $row['Email'];
                                $ZohoContacts->phone = $row['Phone'];
                                $ZohoContacts->description = $row['Description'];
                                $ZohoContacts->currency_symbol = $row['$currency_symbol'];
                                $ZohoContacts->currency = $row['Currency'];
                                $ZohoContacts->rating = $row['Rating'];
                                $ZohoContacts->exchange_rate = $row['Exchange_Rate'];
                                $ZohoContacts->review = $row['$review'];                                
                                $ZohoContacts->review_process_approve = $review_process_approve;
                                $ZohoContacts->review_process_reject = $review_process_reject;
                                $ZohoContacts->review_process_resubmit = $review_process_resubmit;
                              //  $ZohoContacts->website = $row['Website'];
                               // $ZohoContacts->employees = $row['Employees'];
                                //$ZohoContacts->source = $row['Source'];
                                $ZohoContacts->last_activity_time = $last_activity_time;
                               // $ZohoContacts->industry = $row['Industry'];
                                $ZohoContacts->state = $row['$state'];
                                $ZohoContacts->process_flow = $process_flow;
                                $ZohoContacts->account_id = $account_id;
                                $ZohoContacts->account_name = $row['Account_Name'];
                              //  $ZohoContacts->parent_account = $row['Parent_Account'];
                                $ZohoContacts->approved = $account_approved;
                                $ZohoContacts->editable = $editable;
                                $ZohoContacts->orchestration = $orchestration;
                                // $ZohoContacts->shipping_street = $row['Shipping_Street'];
                                // $ZohoContacts->shipping_city = $row['Shipping_City'];
                                // $ZohoContacts->shipping_state = $row['Shipping_State'];
                                // $ZohoContacts->shipping_country = $row['Shipping_Country'];
                                // $ZohoContacts->shipping_code = $row['Shipping_Code'];
                                // $ZohoContacts->billing_street = $row['Billing_Street'];
                                // $ZohoContacts->billing_city = $row['Billing_City'];
                                // $ZohoContacts->billing_country = $row['Billing_Country'];
                                // $ZohoContacts->billing_state = $row['Billing_State'];
                                // $ZohoContacts->billing_code = $row['Billing_Code'];
                                $ZohoContacts->tag = json_encode($row['Tag']);
                               // $ZohoContacts->SIC_Code = $row['SIC_Code'];
                                $ZohoContacts->created_time = $created_time;
                                $ZohoContacts->created_by_id = $created_by['id'];
                                $ZohoContacts->created_by_name = $created_by['name'];
                                $ZohoContacts->created_by_email = $created_by['email'];
                                $ZohoContacts->modified_time = $modified_time;
                                // $ZohoContacts->modified_by_id = $modified_by['id'];
                                // $ZohoContacts->modified_by_name = $modified_by['name'];
                                // $ZohoContacts->modified_by_email = $modified_by['email'];
                                $ZohoContacts->annual_revenue = $row['Annual_Revenue'];
                                $ZohoContacts->approval_state = $row['$approval_state'];
                                $ZohoContacts->in_merge = $in_merge;
                                $ZohoContacts->is_active = 1;
                                $ZohoContacts->created_at = date("Y-m-d H:i:s");
                                $ZohoContacts->updated_at = date("Y-m-d H:i:s");
                                $ZohoContacts->save();
                                

            }

            \Session::put('success','Contact created in ZohoCRM successfully.!');
            return redirect()->route('home');

        }
                \Session::put('error','Contact not create, please try again.!!');
                return redirect()->route('home');
            
        } else {
            \Session::put('error','ZohoCRM token not generated, please try again.!!');
            return redirect()->route('home');
        }        
    }


}
