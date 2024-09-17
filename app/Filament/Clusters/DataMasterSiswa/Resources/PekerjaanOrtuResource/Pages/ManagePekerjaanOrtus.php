<?php

namespace App\Filament\Clusters\DataMasterSiswa\Resources\PekerjaanOrtuResource\Pages;

use App\Filament\Clusters\DataMasterSiswa\Resources\PekerjaanOrtuResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePekerjaanOrtus extends ManageRecords
{
    protected static string $resource = PekerjaanOrtuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
