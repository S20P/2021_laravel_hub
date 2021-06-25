<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;


//Sheets start

use App\Exports\Sheets\TotalNewAccounts;
use App\Exports\Sheets\TopCategoriesCircles;
use App\Exports\Sheets\SalesmangoUserDetails;


//Sheets end 
class LastWeekDataExport implements WithMultipleSheets
{
    private $data;

    public function __construct($data){

       $this->data = $data;
            
    }

    public function sheets(): array
    {
      
        $sheets = [];
        $sheets[] = new TotalNewAccounts($this->data);
        $sheets[] = new SalesmangoUserDetails($this->data);
        $sheets[] = new TopCategoriesCircles($this->data,"Tech");
        $sheets[] = new TopCategoriesCircles($this->data,"Sales/Marketing");
        $sheets[] = new TopCategoriesCircles($this->data,"Civil Engineering");
        $sheets[] = new TopCategoriesCircles($this->data,"Finance");

        return $sheets;
    }
}
