<?php

namespace App\Exports\Sheets;


use DB;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TotalNewAccounts implements WithTitle, WithHeadings, WithMapping,FromCollection,ShouldAutoSize,WithStyles
{
    private $data;

    public function __construct($data){

       $this->data = $data;
            
    }


 public function collection()
    {

        $startDate =  $this->data['startDate'];
        $endDate =  $this->data['endDate'];     

      $response = DB::table("salesmanago_users")
      ->select('createdOn','user_id',DB::raw('Count(DISTINCT(user_id)) AS total'),DB::raw("DATE_FORMAT(createdOn, '%Y-%m-%d') as createdOn"))
      ->where('createdOn', '>=',$startDate)
      ->where('createdOn', '<=',$endDate)
      ->orderBy('createdOn')
      ->groupBy('createdOn')
      ->cursor();

      return $response;


    }

    public function headings(): array
    {
        return [
            'CreatedOn',
            'Total'
        ];
    }
    public function map($response): array
    {

        return [
            $response->createdOn,   
            $response->total,
       ];
    }

   
    public function title(): string
    {
        return 'Total New Accounts';
    }


    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
             1 => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
           // 'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
           // 'C'  => ['font' => ['size' => 16]],
        ];
    }
}
