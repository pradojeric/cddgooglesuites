<?php

namespace App\Imports;

use App\GoogleSuite;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class GoogleSuiteImport implements ToModel, WithUpserts, WithBatchInserts, WithValidation, WithHeadingRow, SkipsEmptyRows
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new GoogleSuite([
            'student_id' => $row['student_id'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'google_account' => $row['google_account'],
            'step_account' => $row['step_account'],
            'cdd_portal_account' => $row['cdd_portal_account'],
        ]);
    }

    public function uniqueBy()
    {
        return 'student_id';
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function rules(): array
    {
        return [
            'student_id' => [
                'required',
                // Rule::unique('google_suites'),
            ],
            // 'google_account' => [
            //     'required',
            //     Rule::unique('google_suites'),
            // ],
            // 'step_account' => [
            //     'required',
            //     Rule::unique('google_suites'),
            // ],
            // 'cdd_portal_account' => [
            //     'required',
            //     Rule::unique('google_suites'),
            // ],
        ];
    }
}
