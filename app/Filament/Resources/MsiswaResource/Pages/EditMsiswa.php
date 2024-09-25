<?php

namespace App\Filament\Resources\MsiswaResource\Pages;

use App\Filament\Resources\MsiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMsiswa extends EditRecord
{
    protected static string $resource = MsiswaResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
        {
            //ambil data ortu dari relasi siswa
            $ortu = $this ->record->OrtuSiswa;

            if($ortu)
                {
                    $data['nomor_kk'] = $ortu->nomor_kk;
                    $data['nm_ayah'] = $ortu->nm_ayah;
                    $data['nik_ayah'] = $ortu->nik_ayah;
                    $data['tahun_lahir_ayah'] = $ortu->tahun_lahir_ayah;
                    $data['pendidikan_ayah_id'] = $ortu->pendidikan_ayah_id;
                    $data['pekerjaan_ayah_id'] = $ortu->pekerjaan_ayah_id;
                    $data['penghasilan_ayah_id'] = $ortu->penghasilan_ayah_id;
                    $data['nohp_ayah'] = $ortu->nohp_ayah;

                    $data['nm_ibu'] = $ortu->nm_ibu;
                    $data['nik_ibu'] = $ortu->nik_ibu;
                    $data['tahun_lahir_ibu'] = $ortu->tahun_lahir_ibu;
                    $data['pendidikan_ibu_id'] = $ortu->pendidikan_ibu_id;
                    $data['pekerjaan_ibu_id'] = $ortu->pekerjaan_ibu_id;
                    $data['penghasilan_ibu_id'] = $ortu->penghasilan_ibu_id;
                    $data['nohp_ibu'] = $ortu->nohp_ibu;

                    $data['nm_wali'] = $ortu->nm_wali;
                    $data['nik_wali'] = $ortu->nik_wali;
                    $data['tahun_lahir_wali'] = $ortu->tahun_lahir_wali;
                    $data['pendidikan_wali_id'] = $ortu->pendidikan_wali_id;
                    $data['pekerjaan_wali_id'] = $ortu->pekerjaan_wali_id;
                    $data['penghasilan_wali_id'] = $ortu->penghasilan_wali_id;
                    $data['nohp_wali'] = $ortu->nohp_wali;
                }
                return $data;
        }

 

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
