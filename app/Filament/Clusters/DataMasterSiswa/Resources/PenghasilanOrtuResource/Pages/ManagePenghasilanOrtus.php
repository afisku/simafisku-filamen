<?php

namespace App\Filament\Clusters\DataMasterSiswa\Resources\PenghasilanOrtuResource\Pages;

use App\Filament\Clusters\DataMasterSiswa\Resources\PenghasilanOrtuResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePenghasilanOrtus extends ManageRecords
{
    protected static string $resource = PenghasilanOrtuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
