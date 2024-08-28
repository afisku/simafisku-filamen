<?php

namespace App\Filament\Clusters\Surat\Resources\SuratKeluarResource\Pages;

use App\Filament\Clusters\Surat\Resources\SuratKeluarResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSuratKeluar extends CreateRecord
{
    protected static string $resource = SuratKeluarResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
        {
            $data['no_surat'] = $this->data['no_surat'] ?? '';
            // Menambahkan ID user yang sedang login ke field 'dibuat_oleh'
            $data['dibuat_oleh'] = auth()->id();
            // dd($data);
            return $data;
        }

}
