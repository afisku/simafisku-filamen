<?php

namespace App\Filament\Clusters\DataMasterSiswa\Resources\WaktuTempuhResource\Pages;

use App\Filament\Clusters\DataMasterSiswa\Resources\WaktuTempuhResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageWaktuTempuhs extends ManageRecords
{
    protected static string $resource = WaktuTempuhResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
