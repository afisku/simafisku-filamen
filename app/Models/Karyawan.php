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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jabatanPegawai()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function posisiKerja()
    {
        return $this->belongsTo(PosisiKerja::class, 'posisi_kerja_id');
    }

    public function unitKerja()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function pendidikanTerakhir()
    {
        return $this->belongsTo(PendidikanTerakhir::class, 'pendidikan_terakhir_id');
    }

    public function gelarPendidikan()
    {
        return $this->belongsTo(GelarPendidikan::class, 'gelar_pendidikan_id');
    }

    public function statusKaryawan()
    {
        return $this->belongsTo(StatusKepegawaian::class, 'status_karyawan_id');
    }

    public function getTempatTanggalLahirAttribute()
    {
        return $this->tempat_lahir . ', ' . \Carbon\Carbon::parse($this->tanggal_lahir)->translatedFormat('d F Y');
    }

    public function getJenisKelaminFullAttribute()
{
    return $this->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
}
}
