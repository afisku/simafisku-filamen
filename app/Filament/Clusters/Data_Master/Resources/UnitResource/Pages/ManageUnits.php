<?php

namespace App\Filament\Clusters\Data_Master\Resources\UnitResource\Pages;

use App\Filament\Clusters\Data_Master\Resources\UnitResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageUnits extends ManageRecords
{
    protected static string $resource = UnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
