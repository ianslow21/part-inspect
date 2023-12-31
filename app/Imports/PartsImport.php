<?php

namespace App\Imports;

use App\Models\Parts;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class PartsImport implements ToModel, WithStartRow, WithCustomCsvSettings
{
    public function startRow(): int
    {
        return 2;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Parts([
            'part_number'     => $row[0],
            'part_name'    => $row[1],
            'supplier' => ($row[2]),
            'dimension' => ($row[3]),
            'judgement' => ($row[4]),

        ]);
    }
}
