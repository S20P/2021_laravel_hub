<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class ExcelController extends Controller
{
    
    


    public function importExportView()
    {
       return view('import');
    }

    public function export() 
    {
            // return Excel::download(new UsersExport, 'users.xlsx');
           // return Excel::download(new UsersExport(2021), 'users.xlsx');

    //using Setters method start
           
            // $export = new UsersExport();
            // $export->setYear(2021);
     
            

            $param = [
                "year"=>2021,
                "score"=>90
            ];
            
         return   Excel::download(new UsersExport($param), 'users.xlsx');

      

          $file_path =  public_path('excels');
          $file_name =  "invoices".time().".xlsx";
           
         
          Excel::store(new UsersExport($param), $file_name, 'excels');        
          

           $file_url = $file_path."/".$file_name;


         $to_email = "programmer19@dynamicdreamz.com";    
        Mail::raw('Hi,Download Excel file!', function ($message) use($to_email,$file_url){
            $message->to($to_email, 'http://bi.talentmatchglobal.com/ : Excel');
            $message->subject('http://bi.talentmatchglobal.com/ : Excel : data');
            $message->attach($file_url);
          });
          
          return back();


//return Excel::store(new UsersExport($param), 'invoices.xlsx', '/'); //Or store it on a disk, (e.g. s3):


    //using Setters method end


    }

    public function import() 
    {
        Excel::import(new UsersImport,request()->file('file'));
             
        return back();
    }

}
