<?php

namespace App\Filament\Clusters\DataMasterSiswa\Resources\JarakRumahResource\Pages;

use App\Filament\Clusters\DataMasterSiswa\Resources\JarakRumahResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageJarakRumahs extends ManageRecords
{
    protected static string $resource = JarakRumahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
