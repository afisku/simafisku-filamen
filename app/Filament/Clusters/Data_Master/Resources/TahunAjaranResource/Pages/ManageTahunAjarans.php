<?php

namespace App\Filament\Clusters\Data_Master\Resources\TahunAjaranResource\Pages;

use App\Filament\Clusters\Data_Master\Resources\TahunAjaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTahunAjarans extends ManageRecords
{
    protected static string $resource = TahunAjaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
