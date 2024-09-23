<?php

namespace App\Filament\Clusters\Surat\Resources\SuratKeluarResource\Pages;

use App\Filament\Clusters\Surat\Resources\SuratKeluarResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSuratKeluar extends CreateRecord
{
    protected static string $resource = SuratKeluarResource::class;

    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
        {
            $data['no_surat'] = $this->data['no_surat'] ?? '';
            // Menambahkan ID user yang sedang login ke field 'dibuat_oleh'
            $data['dibuat_oleh'] = auth()->id();
            // dd($data);

             // Mengambil tahun ajaran yang aktif
            $activeTahunAjaran = \App\Models\TahunAjaran::where('status', true)->first();
            // Set th_ajaran_id dengan ID tahun ajaran yang aktif
                if ($activeTahunAjaran) {
                    $data['th_ajaran_id'] = $activeTahunAjaran->id;
                } else {
                    // Jika tidak ada tahun ajaran yang aktif, bisa mengatur logika alternatif di sini
                    throw new \Exception('Tidak ada tahun ajaran yang aktif.');
                }
            return $data;
        }

}
