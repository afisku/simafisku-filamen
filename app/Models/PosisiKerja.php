<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosisiKerja extends Model
{
    use HasFactory;
    protected $table = 'posisi_kerja';

    public function karyawans()
    {
        return $this->hasMany(Karyawan::class);
    }
}
