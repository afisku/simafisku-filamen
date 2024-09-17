<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = "surat_keluar";

    protected $fillable = [
        "no_surat",
        "kategori_surat_id",
        "tgl_surat_keluar",
        "perihal",
        "tujuan_pengiriman",
        "dokumen",
        "dibuat_oleh",
        "th_ajaran_id",
    ];

    public function dibuatOleh() : BelongsTo
    {
        return $this->belongsTo(User::class, 'dibuat_oleh', 'id');
    }
   


    public function kategoriSurat(): BelongsTo
    {
        return $this->belongsTo(KategoriSurat::class);
    }



    public function tahunAjaran(): BelongsTo
    {
        return $this->belongsTo(TahunAjaran::class, 'th_ajaran_id', 'id');
    }

}
