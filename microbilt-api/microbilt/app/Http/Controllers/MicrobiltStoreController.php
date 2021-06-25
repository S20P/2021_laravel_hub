<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use App\Models\MicrobiltStore;
class MicrobiltStoreController extends Controller
{
    
    protected $accessToken;
    public $client_id,$client_secret,$app_url;

    public function __construct()
    {        
        $this->client_id = env('MICROBILT_CLIENT_ID');
        $this->client_secret = env('MICROBILT_CLIENT_SECRET');
        $this->app_url=env('MICROBILT_API_DOMAIN');
    }

    private function getAccessToken(): string
    {
        if ($this->accessToken !== null) {
            return $this->accessToken;
        }

        $RowArray = [
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'grant_type' => 'client_credentials',
        ];

        $url = $this->app_url."/OAuth/GetAccessToken";
        //"https://apitest.microbilt.com/OAuth/GetAccessToken"
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($RowArray),
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "content-type: application/json",
                "Accept: application/json",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if (!$err) {
           
            $parsedResponse = json_decode($response);
            $this->accessToken = $parsedResponse->access_token;
        }
        return $this->accessToken;
    }



    

    public function GetReportList()
    {
        $BankruptcyData = MicrobiltStore::where('api_type',"Bankruptcy")->paginate(10);
        $EvictionsData = MicrobiltStore::where('api_type',"Evictions")->paginate(10);
        $CriminalData = MicrobiltStore::where('api_type',"Criminal")->paginate(10);
        return view('MicrobiltStore.SearchIndex',compact('CriminalData','BankruptcyData','EvictionsData'));
    }

    // Bankruptcy Search 
    public function GetReportForm()
    {
        return view('MicrobiltStore.SearchCreate');
    }
 
    public function GetReportSave(Request $request)
    {
            $request->validate([
                'LastName'=>'required',
                'FirstName'=> 'required',
                'Addr1'=>'required',
                'PostalCode'=>'required',
            ]); 
       
            $input = $request->all();

            $PersonName = [];
            $ContactInfo = [];
            $TINInfo = [];
            $PersonInfo = [];
            $PostAddr = [];

            $PersonName = [
                "LastName" => $input['LastName'],
                "FirstName" => $input['FirstName'],
                // "MiddleName" => $input['MiddleName'],
            ];

            // $TINInfo = [
            //     "TINType" => $input['TINType'],
            //     "TaxId" => $input['TaxId'],
            // ];
          
            
            $API_TYPE = $input['api_type'];

             if($API_TYPE=="Bankruptcy"){
                $url = $this->app_url."/BankruptcySearch/GetReport";
                // $PersonInfo["TINInfo"] = $TINInfo;
                $PostAddr["Addr1"] = $input['Addr1'];
                $PostAddr["City"] = $input['City'];
                $PostAddr["StateProv"] = $input['StateProv'];
                $PostAddr["PostalCode"] = $input['PostalCode'];
             }
             if($API_TYPE=="Evictions"){
                $url = $this->app_url."/EvictionsSearch/GetReport";
                $PostAddr["Addr1"] = $input['Addr1'];
                $PostAddr["City"] = $input['City'];
                $PostAddr["StateProv"] = $input['StateProv'];
                $PostAddr["PostalCode"] = $input['PostalCode'];
            }
            if($API_TYPE=="Criminal"){
                $url = $this->app_url."/CriminalSearch/GetReport";
                $BirthDt =  $input['BirthDt'];
                $PostAddr["Addr1"] = $input['Addr1'];
                $PostAddr["PostalCode"] = $input['PostalCode'];
            }
                      
            $ContactInfo = [
                "PostAddr" => $PostAddr
            ];

            $PersonInfo = [
                "PersonName" => $PersonName,
                "ContactInfo" => $ContactInfo,
            ];

            $RowArray  = [
                "PersonInfo" => $PersonInfo
            ];


       // CURL

                // $data = '{
                //     "PersonInfo": {
                //       "PersonName": {
                //         "LastName": "GEARY",
                //         "FirstName": "CORINNE",
                //         "MiddleName": "B"
                //       },
                //       "ContactInfo": {
                //         "PostAddr": {
                //           "Addr1": "1119 ALTON WOODS DR",
                //           "City": "CONCORD",
                //           "StateProv": "NH",
                //           "PostalCode": "03301"
                //         }
                //       },
                //       "TINInfo": {
                //         "TINType": "SSN",
                //         "TaxId": "113588800"
                //       }
                //     }
                //   }';


                // $Criminal_Test_data = '{
                //     "PersonInfo": {
                //       "PersonName": {
                //         "FirstName": "YVONNE",
                //         "LastName": "GELINAS"
                //       },
                //       "ContactInfo": {
                //         "PostAddr": {
                //           "Addr1": "48 ALLENSTOWN RD",
                //           "PostalCode": "03275"
                //         }
                //       },
                //       "BirthDt": "1980-09-06"
                //     }
                //   }';

              


                $ACCESS_TOKEN = $this->getAccessToken();

            //   dd($ACCESS_TOKEN);

                
                // https://apitest.microbilt.com/BankruptcySearch/GetReport"
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30000,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                      //  CURLOPT_POSTFIELDS => $Criminal_Test_data,
                        CURLOPT_POSTFIELDS => json_encode($RowArray),
                        CURLOPT_HTTPHEADER => array(
                            // Set here requred headers
                            "content-type: application/json",
                            "Accept: application/json",
                            //"Authorization: Bearer 4Tx2lZUJ8RL9fps1nGJxRS5kbSGK",
                            'Authorization: Bearer ' .$ACCESS_TOKEN,
                        ),
                    ));
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    if ($err) {
                        return redirect()->back()->with('error',$err); 
                    } else {
                        $data = json_decode($response, true);
                    
                        if(isset($data['fault'])){
                            $err = $data['fault']['faultstring'];
                            return redirect()->back()->with('error',$err); 
                        }

                        $RqUID = $data['MsgRsHdr']['RqUID'];
            
                        $RqUID_val = str_replace( array( '{', '}'), ' ', $RqUID);
                
                
                        $MicrobiltStore = new MicrobiltStore([
                            'RqUID' => $RqUID_val,
                             'api_type' => $API_TYPE,
                            'response'=> $data,
                        ]); 

                        $MicrobiltStore->save();
                        return redirect()->back()->with('success', 'Success'); 
                    }

           // CURL end
           return redirect()->back()->with('error', 'error'); 
     }

    // Bankruptcy Search end

    public function GetArchiveReport(Request $request)
    {
        $input = $request->all();
          
        $AppId = $input['AppId'];
        $ReportType = $input['ReportType'];


        if($ReportType=="Evictions"){
            $url = $this->app_url."/EvictionsSearch/GetArchiveReport?AppId=".$AppId;
        }
        if($ReportType=="Criminal"){
            $url = $this->app_url."/CriminalSearch/GetArchiveReport?AppId=".$AppId;
        }

        $ACCESS_TOKEN = $this->getAccessToken();


        $RowArray = [
           
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "Accept: application/json",
                //"Authorization: Bearer 4Tx2lZUJ8RL9fps1nGJxRS5kbSGK",
                'Authorization: Bearer ' .$ACCESS_TOKEN,
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return response()->json(['success'=>false]);
        } else {
            $data = json_decode($response, true);
        
            if(isset($data['fault'])){
                $err = $data['fault']['faultstring'];
                return response()->json(['success'=>false]);
            }

            return response()->json(['success'=>true,"data"=>$data]);
        }
     
        return response()->json(['success'=>false]);
    }
  

}
