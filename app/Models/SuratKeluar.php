<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = "surat_keluar";

    protected $fillabel = [
        "no_surat",
        "kategori_surat_id",
        "tgl_surat_keluar",
        "perihal",
        "tujuan_pengiriman",
        "dokumen",
        "tujuan_pengiriman",
        "dibuat_oleh",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
   
    public function kategoriSurat()
    {
        return $this->belongsTo(KategoriSurat::class, 'kategori_surat_id');
    }

}
