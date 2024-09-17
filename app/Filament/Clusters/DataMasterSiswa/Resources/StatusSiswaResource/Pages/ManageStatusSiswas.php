<?php

namespace App\Filament\Clusters\DataMasterSiswa\Resources\StatusSiswaResource\Pages;

use App\Filament\Clusters\DataMasterSiswa\Resources\StatusSiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageStatusSiswas extends ManageRecords
{
    protected static string $resource = StatusSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
