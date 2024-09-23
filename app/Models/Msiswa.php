<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Msiswa extends Model
{
    use HasFactory;

     // Nama tabel yang digunakan oleh model
     protected $table = 'siswa';
 
     // Kolom-kolom yang dapat diisi secara massal
     protected $fillable = [
         'asal_sekolah', 'nspn', 'nm_siswa', 'jk', 'nisn', 'nis', 'nik', 
        'tempat_lahir', 'tgl_lahir', 'agama_id', 'provinsi_asal', 'kabkota_asal', 
        'kecamatan_asal', 'desalurah_asal', 'alamat_asal', 'rt_asal', 'rw_asal', 
        'kodepos_asal', 'transportasi_id', 'yatim_piatu', 'penyakit', 'jarak_rumah_id', 
        'jumlah_saudara', 'anak_ke', 'dari_bersaudara', 'foto', 'doc_mutasi', 
        'status_siswa_id', 'tahun_ajaran_id', 'ortu_siswa_id'
     ];

    // Relasi ke OrtuSiswa (Many-to-One)
    public function ortuSiswa() : BelongsTo
    {
        return $this->belongsTo(OrtuSiswa::class, 'ortu_siswa_id', 'id');
    }

    // Relasi ke Agama (Many-to-One)
    public function agama() : BelongsTo
    {
        return $this->belongsTo(Agama::class, 'agama_id', 'id');
    }

    // Relasi ke Transportasi (Many-to-One)
    public function transportasi() : BelongsTo
    {
        return $this->belongsTo(Transportasi::class, 'transportasi_id', 'id');
    }

    // Relasi ke JarakRumah (Many-to-One)
    public function jarakRumah() : BelongsTo
    {
        return $this->belongsTo(JarakRumah::class, 'jarak_rumah_id', 'id');
    }

    // Relasi ke StatusSiswa (Many-to-One)
    public function statusSiswa() : BelongsTo
    {
        return $this->belongsTo(StatusSiswa::class, 'status_siswa_id', 'id');
    }
    // Relasi ke TahunAjaran (Many-to-One)
    public function tahunAjaran() : BelongsTo
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id', 'id');
    }

     // Accessor untuk nilai null yang diganti dengan '-'
     public function getStatusSiswaIdAttribute($value)
     {
         return $value === null ? '-' : $value;
     }
}
