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

class TopCategoriesCircles implements WithTitle, WithHeadings, WithMapping,FromCollection,ShouldAutoSize,WithStyles
{
    private $data;
    private $category;


    public function __construct($data,$category){

       $this->data = $data;
       $this->category = $category;

            
    }


 public function collection()
    {

        $startDate =  $this->data['startDate'];
        $endDate =  $this->data['endDate'];
        $category =  $this->category;

       
        $response =  DB::table("salesmanago_users")
                    ->select('companies_followeds.target_category as category','salesmanago_users.createdOn','salesmanago_users.user_id','salesmanago_users.email',DB::raw("DATE_FORMAT(salesmanago_users.createdOn, '%Y-%m-%d') as createdOn"))
                    ->join('companies_followeds','salesmanago_users.user_id', '=', 'companies_followeds.user_id')
                    ->where('salesmanago_users.createdOn', '>=',$startDate)
                     ->where('salesmanago_users.createdOn', '<=',$endDate)
                     ->where('target_category',"=",$category)
                    ->groupBy('salesmanago_users.email')
                    ->cursor();
  
  
        return $response;

    }

    public function headings(): array
    {
        return [
            'Category',
            'CreatedOn',
            'User_id',
            'Email',
        ];
    }
    public function map($response): array
    {

        return [
            $response->category,
            $response->createdOn,
            $response->user_id, 
            $response->email,
       ];
    }

   
    public function title(): string
    {
        return 'Top ' . $this->category;
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
