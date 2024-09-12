<?php

namespace App\Filament\Clusters\DataMasterSiswa\Resources\CStatusSiswaResource\Pages;

use App\Filament\Clusters\DataMasterSiswa\Resources\CStatusSiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCStatusSiswa extends EditRecord
{
    protected static string $resource = CStatusSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
