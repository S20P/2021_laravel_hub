<?php

namespace App\Exports;

use App\Exports\Sheets\LastWeekDataShhet1;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
class UsersExport implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */


    private $data;

    public function __construct($data){

       $this->data = $data;
            
    }

    public function sheets(): array
    {
      
        $sheets = [];
        $sheets[] = new LastWeekDataShhet1($this->data);
        $sheets[] = new LastWeekDataShhet1($this->data);

        return $sheets;
    }


}
