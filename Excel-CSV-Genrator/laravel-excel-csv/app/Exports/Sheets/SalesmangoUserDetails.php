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

class SalesmangoUserDetails implements WithTitle, WithHeadings, WithMapping,FromCollection,ShouldAutoSize,WithStyles
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
      ->select('salesmanago_users.email','salesmanago_users.score','salesmanago_users.is_active','salesmanago_users.utm_source','salesmanago_users.profiles_complete','salesmanago_users.profile_status','users_scores.score as matching_score',DB::raw("DATE_FORMAT(salesmanago_users.createdOn, '%Y-%m-%d') as createdOn"))
      ->leftJoin('users_scores','salesmanago_users.user_id', '=', 'users_scores.user_id')
      ->where('salesmanago_users.createdOn', '>=',$startDate)
      ->where('salesmanago_users.createdOn', '<=',$endDate)
      ->orderBy('salesmanago_users.createdOn')
      ->groupBy('salesmanago_users.user_id')
      ->cursor();


      return $response;


    }

    public function headings(): array
    {
        return [
            'email',
            'score',
            'is_active',
            'utm_source',
            'profiles_complete',
            'profile_status',
            'Matching score',
            'createdOn',
        ];
    }
    public function map($response): array
    {

        return [
            $response->email,   
            $response->score,
            $response->is_active,
            $response->utm_source,
            $response->profiles_complete,
            $response->profile_status,
            $response->matching_score,
            $response->createdOn,

       ];
    }

   
    public function title(): string
    {
        return 'Salesmanago users details';
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
