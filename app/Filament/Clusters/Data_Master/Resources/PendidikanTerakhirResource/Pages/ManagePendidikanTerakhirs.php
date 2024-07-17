<?php

namespace App\Filament\Clusters\Data_Master\Resources\PendidikanTerakhirResource\Pages;

use App\Filament\Clusters\Data_Master\Resources\PendidikanTerakhirResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePendidikanTerakhirs extends ManageRecords
{
    protected static string $resource = PendidikanTerakhirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
