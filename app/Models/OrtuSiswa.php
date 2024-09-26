<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrtuSiswa extends Model
{
    use HasFactory;

    protected $table = 'ortu_siswa';

    protected $fillable = [
        'nomor_kk',
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
        'nohp_wali'
    ];
    public function siswa() : HasMany
    {
        return $this->hasMany(Msiswa::class, 'ortu_siswa_id', 'id');
    }

    public function pekerjaanAyah() : BelongsTo
    {
        return $this->belongsTo(PekerjaanOrtu::class, 'pekerjaan_ayah_id', 'id');
    }

    public function pekerjaanIbu() : BelongsTo
    {
        return $this->belongsTo(PekerjaanOrtu::class, 'pekerjaan_ibu_id', 'id');
    }
    public function pekerjaanWali() : BelongsTo
    {
        return $this->belongsTo(PekerjaanOrtu::class, 'pekerjaan_wali_id', 'id');
    }

    public function pendidikanAyah() : BelongsTo
    {
        return $this->belongsTo(PendidikanOrtu::class, 'pendidikan_ayah_id', 'id');
    }

    public function pendidikanIbu() : BelongsTo
    {
        return $this->belongsTo(PendidikanOrtu::class, 'pendidikan_ibu_id', 'id');
    }
    public function pendidikanWali() : BelongsTo
    {
        return $this->belongsTo(PendidikanOrtu::class, 'pendidikan_wali_id', 'id');
    }
    public function penghasilanAyah() : BelongsTo
    {
        return $this->belongsTo(PenghasilanOrtu::class, 'penghasilan_ayah_id', 'id');
    }

    public function penghasilanIbu() : BelongsTo
    {
        return $this->belongsTo(PenghasilanOrtu::class, 'penghasilan_ibu_id', 'id');
    }
    public function penghasilanWali() : BelongsTo
    {
        return $this->belongsTo(PenghasilanOrtu::class, 'penghasilan_wali_id', 'id');
    }

    

}
