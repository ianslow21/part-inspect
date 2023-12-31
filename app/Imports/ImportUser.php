<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportUser implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'nik' => $row[0],
            'name' => $row[1],
            'role' => $row[2],
            'email' => $row[3],
            'password' => bcrypt($row[4]),
        ]);
    }
}
