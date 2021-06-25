<?php

namespace App\Exports\Sheets;

use App\Models\User;
use App\Models\UserScore;

use DB;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LastWeekDataShhet1 implements WithTitle, WithHeadings, WithMapping,FromCollection,ShouldAutoSize,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */


    private $data;

    public function __construct($data){

       $this->data = $data;
            
    }


 public function collection()
    {

      $year =  $this->data['year'];
      $score =  $this->data['score'];
      //   return User::all();
        return User::select('user_scores.*','users.*')
        ->join('user_scores','users.id','=','user_scores.user_id')
        ->where('user_scores.score',">=",$score)
        ->whereYear('users.created_at', $year)->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'User Name',
            'Email',
            'Score',
            'Date'
        ];
    }
    public function map($user): array
    {

        return [
            $user->id,
            $user->name,
            $user->email,  
            $user->score, 
            $user->created_at,    
       ];
    }

   
    public function title(): string
    {
        return 'Month ' . $this->data['year'];
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
