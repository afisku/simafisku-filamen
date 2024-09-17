<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;
    protected $table = 'tahun_ajaran';

    protected $fillable = [
        'ta',
        'angkatan',
        'periode_mulai',
        'periode_akhir',
        'status'
    ];

    public function suratKeluars()
    {
        return $this->hasMany(SuratKeluar::class, 'th_ajaran_id'); // 'th_ajaran_id' adalah foreign key di surat_keluar
    }
}
