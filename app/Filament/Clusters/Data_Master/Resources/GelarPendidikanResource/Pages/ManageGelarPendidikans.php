<?php

namespace App\Filament\Clusters\Data_Master\Resources\GelarPendidikanResource\Pages;

use App\Filament\Clusters\Data_Master\Resources\GelarPendidikanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageGelarPendidikans extends ManageRecords
{
    protected static string $resource = GelarPendidikanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
