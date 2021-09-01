<?php

namespace App\Imports;

use App\GoogleSuite;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AccountImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {

        foreach($rows as $row){

            if($row['student_id'] == null)
                continue;

            GoogleSuite::updateOrCreate(
                ['student_id' => $row['student_id']],
                [
                    'student_id' => $row['student_id'],
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'google_account' => $row['google_account'],
                    'step_account' => $row['step_account'],
                    'cdd_portal_account' => $row['cdd_portal_account'],
                ],
            );
        }
    }
}
