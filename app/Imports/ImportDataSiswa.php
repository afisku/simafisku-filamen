<?php

namespace App\Imports;

use App\Models\Msiswa;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportDataSiswa implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Msiswa([
            'nis' => $row[0],
            'nisn' => $row[1],
            'nm_siswa' => $row[2],
            'jk' => $row[3],
            'tempat_lahir' => $row[4],
            'tgl_lahir' => $row[5],
            'status_siswa_id' => $row[6],
        ]);
    }
}
