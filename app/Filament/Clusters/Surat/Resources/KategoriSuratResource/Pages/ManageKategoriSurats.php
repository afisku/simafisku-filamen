<?php

namespace App\Filament\Clusters\Surat\Resources\KategoriSuratResource\Pages;

use App\Filament\Clusters\Surat\Resources\KategoriSuratResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKategoriSurats extends ManageRecords
{
    protected static string $resource = KategoriSuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
