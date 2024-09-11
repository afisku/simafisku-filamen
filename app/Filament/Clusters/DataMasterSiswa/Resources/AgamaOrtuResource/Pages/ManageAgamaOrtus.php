<?php

namespace App\Filament\Clusters\DataMasterSiswa\Resources\AgamaOrtuResource\Pages;

use App\Filament\Clusters\DataMasterSiswa\Resources\AgamaOrtuResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAgamaOrtus extends ManageRecords
{
    protected static string $resource = AgamaOrtuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
