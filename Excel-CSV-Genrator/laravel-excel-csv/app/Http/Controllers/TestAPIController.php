<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Excel;

class TestAPIController extends Controller
{
    
    public function fileExportExcel(Request $request)
    {
       
          $data = User::all();

        // return response()->json(["data"=>$data]);
          $users = User::all();

          $filepath = asset('LastWeekData.xlsx');

          echo $filepath;

          Excel::load($filepath, function($reader) {

            // reader methods

            print_r($reader);
        
        });

    }

}
