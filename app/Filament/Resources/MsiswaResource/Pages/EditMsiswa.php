<?php

namespace App\Filament\Resources\MsiswaResource\Pages;

use App\Filament\Resources\MsiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMsiswa extends EditRecord
{
    protected static string $resource = MsiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
