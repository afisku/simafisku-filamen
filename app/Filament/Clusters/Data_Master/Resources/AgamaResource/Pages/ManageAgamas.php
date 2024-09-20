<?php

namespace App\Filament\Clusters\Data_Master\Resources\AgamaResource\Pages;

use App\Filament\Clusters\Data_Master\Resources\AgamaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAgamas extends ManageRecords
{
    protected static string $resource = AgamaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
