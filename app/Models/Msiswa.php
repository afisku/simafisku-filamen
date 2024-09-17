<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Msiswa extends Model
{
    use HasFactory;

     // Nama tabel yang digunakan oleh model
     protected $table = 'siswa';

     // Jika kamu tidak menggunakan timestamps di tabel
     public $timestamps = true;
 
     // Kolom-kolom yang dapat diisi secara massal
     protected $fillable = [
         'asal_sekolah',
         'nspn',
         'nm_siswa',
         'jk',
         'nis',
         'nisn',
         'nik',
         'tempat_lahir',
         'tgl_lahir',
         'agama_id',
         'provinsi_asal',
         'kabkota_asal',
         'kecamatan_asal',
         'desalurah_asal',
         'alamat_asal',
         'rt_asal',
         'rw_asal',
         'kodepos_asal',
         'transportasi_id',
         'yatim_piatu',
         'penyakit',
         'jarak_rumah_id',
         'jumlah_saudara',
         'anak_ke',
         'dari_bersaudara',
         'foto',
         'doc_mutasi',
         'status_siswa_id',
         'tahun_ajaran_id',
         'nm_ayah',
         'nik_ayah',
         'tahun_lahir_ayah',
         'pendidikan_ayah_id',
         'pekerjaan_ayah_id',
         'penghasilan_ayah_id',
         'nohp_ayah',
         'nm_ibu',
         'nik_ibu',
         'tahun_lahir_ibu',
         'pendidikan_ibu_id',
         'pekerjaan_ibu_id',
         'penghasilan_ibu_id',
         'nohp_ibu',
         'nm_wali',
         'nik_wali',
         'tahun_lahir_wali',
         'pendidikan_wali_id',
         'pekerjaan_wali_id',
         'penghasilan_wali_id',
         'nohp_wali',
     ];
 
     // Definisikan relasi dengan tabel status_siswa
     public function statusSiswa()
     {
         return $this->belongsTo(StatusSiswa::class, 'status_siswa_id');
     }
 
     // Definisikan relasi dengan tabel tahun_ajaran
     public function tahunAjaran()
     {
         return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
     }
 
     // Definisikan relasi dengan tabel transportasi
     public function transportasi()
     {
         return $this->belongsTo(Transportasi::class, 'transportasi_id');
     }
 
     // Definisikan relasi dengan tabel jarak_rumah
     public function jarakRumah()
     {
         return $this->belongsTo(JarakRumah::class, 'jarak_rumah_id');
     }
 
     // Definisikan relasi dengan tabel agama_ortu
     public function agamaAyah()
     {
         return $this->belongsTo(AgamaOrtu::class, 'agama_id');
     }
 
     // Definisikan relasi dengan tabel pendidikan_ortu
     public function pendidikanAyah()
     {
         return $this->belongsTo(PendidikanOrtu::class, 'pendidikan_ayah_id');
     }
 
     public function pendidikanIbu()
     {
         return $this->belongsTo(PendidikanOrtu::class, 'pendidikan_ibu_id');
     }
 
     // Definisikan relasi dengan tabel pekerjaan_ortu
     public function pekerjaanAyah()
     {
         return $this->belongsTo(PekerjaanOrtu::class, 'pekerjaan_ayah_id');
     }
 
     public function pekerjaanIbu()
     {
         return $this->belongsTo(PekerjaanOrtu::class, 'pekerjaan_ibu_id');
     }
 
     // Definisikan relasi dengan tabel penghasilan_ortu
     public function penghasilanAyah()
     {
         return $this->belongsTo(PenghasilanOrtu::class, 'penghasilan_ayah_id');
     }
 
     public function penghasilanIbu()
     {
         return $this->belongsTo(PenghasilanOrtu::class, 'penghasilan_ibu_id');
     }

     public function statusStuden()
     {
         return $this->belongsTo(StatusSiswa::class, 'status_siswa_id');
     }
 
     // Accessor untuk nilai null yang diganti dengan '-'
     public function getStatusSiswaIdAttribute($value)
     {
         return $value === null ? '-' : $value;
     }
}
