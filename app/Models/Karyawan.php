<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';

    protected $fillable = [
        'npy',
        'nama_lengkap',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'nomor_telepon',
        'user_id',
        'jabatan_id',
        'posisi_kerja_id',
        'unit_id',
        'tanggal_mulai_bekerja',
        'status_karyawan',
        'pendidikan_terakhir_id',
        'gelar_pendidikan_id',
        'jurusan',
        'institusi_pendidikan',
        'tahun_lulus',
        'nama_pasangan',
        'jumlah_anak',
        'kontak_darurat',
        'foto_karyawan',
        'scan_ktp',
        'scan_kk',
        'scan_ijazah_terakhir',
        'scan_sertifikat_penghargaan',
        'sertifikat_prestasi',
        'scan_sk_yayasan',
        'scan_sk_mengajar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function posisiKerja()
    {
        return $this->belongsTo(PosisiKerja::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function pendidikanTerakhir()
    {
        return $this->belongsTo(PendidikanTerakhir::class);
    }

    public function gelarPendidikan()
    {
        return $this->belongsTo(GelarPendidikan::class);
    }

    public function statusKaryawan()
    {
        return $this->belongsTo(StatusKepegawaian::class);
    }
}
