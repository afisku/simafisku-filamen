<?php

namespace App\Filament\Clusters\Surat\Resources\SuratKeluarResource\Pages;

use App\Filament\Clusters\Surat\Resources\SuratKeluarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSuratKeluar extends EditRecord
{
    protected static string $resource = SuratKeluarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
