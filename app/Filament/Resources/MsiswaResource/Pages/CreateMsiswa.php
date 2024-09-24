<?php

namespace App\Filament\Resources\MsiswaResource\Pages;

use App\Filament\Resources\MsiswaResource;
use App\Models\Msiswa;
use App\Models\OrtuSiswa;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMsiswa extends CreateRecord
{
    protected static string $resource = MsiswaResource::class;

     // Tambahkan method handleRecordCreation di sini
     protected function handleRecordCreation(array $data): Msiswa
     {
         // Buat record OrtuSiswa terlebih dahulu
         $ortu = OrtuSiswa::create([
             'nomor_kk' => $data['nomor_kk'],
             'nm_ayah' => $data['nm_ayah'],
             'nik_ayah' => $data['nik_ayah'],
             'tahun_lahir_ayah' => $data['tahun_lahir_ayah'],
             'pendidikan_ayah_id' => $data['pendidikan_ayah_id'],
             'pekerjaan_ayah_id' => $data['pekerjaan_ayah_id'],
             'penghasilan_ayah_id' => $data['penghasilan_ayah_id'],
             'nohp_ayah' => $data['nohp_ayah'],
             'nm_ibu' => $data['nm_ibu'],
             'nik_ibu' => $data['nik_ibu'],
             'tahun_lahir_ibu' => $data['tahun_lahir_ibu'],
             'pendidikan_ibu_id' => $data['pendidikan_ibu_id'],
             'pekerjaan_ibu_id' => $data['pekerjaan_ibu_id'],
             'penghasilan_ibu_id' => $data['penghasilan_ibu_id'],
             'nohp_ibu' => $data['nohp_ibu'],
             'nm_wali' => $data['nm_wali'],
             'nik_wali' => $data['nik_wali'],
             'tahun_lahir_wali' => $data['tahun_lahir_wali'],
             'pendidikan_wali_id' => $data['pendidikan_wali_id'],
             'pekerjaan_wali_id' => $data['pekerjaan_wali_id'],
             'penghasilan_wali_id' => $data['penghasilan_wali_id'],
             'nohp_wali' => $data['nohp_wali'],
         ]);
 
         // Buat record siswa tanpa ortu_siswa_id terlebih dahulu
         $siswa = Msiswa::create([
             'nm_siswa' => $data['nm_siswa'],
             'nis' => $data['nis'],
             'nisn' => $data['nisn'],
             'nik' => $data['nik'],
             'tempat_lahir' => $data['tempat_lahir'],
             'tgl_lahir' => $data['tgl_lahir'],
             'jk' => $data['jk'],
             'agama_id' => $data['agama_id'],
             'provinsi_asal' => $data['provinsi_asal'],
             'kabkota_asal' => $data['kabkota_asal'],
             'kecamatan_asal' => $data['kecamatan_asal'],
             'desalurah_asal' => $data['desalurah_asal'],
             'alamat_asal' => $data['alamat_asal'],
             'rt_asal' => $data['rt_asal'],
             'rw_asal' => $data['rw_asal'],
             'jumlah_saudara' => $data['jumlah_saudara'],
             'anak_ke' => $data['anak_ke'],
             'dari_bersaudara' => $data['dari_bersaudara'],
             'asal_sekolah' => $data['asal_sekolah'],
             'nspn' => $data['nspn'],
             'kodepos_asal' => $data['kodepos_asal'],
             'transportasi_id' => $data['transportasi_id'],
             'jarak_rumah_id' => $data['jarak_rumah_id'],
             'foto' => $data['foto'],
             'doc_mutasi' => $data['doc_mutasi'],
             'status_siswa_id' => $data['status_siswa_id'],
             'tahun_ajaran_id' => $data['tahun_ajaran_id'],
         ]);
 
         // Update siswa dengan ortu_siswa_id yang baru dibuat
         $siswa->ortu_siswa_id = $ortu->id;
         $siswa->save();
 
         return $siswa;
     }

     
}
