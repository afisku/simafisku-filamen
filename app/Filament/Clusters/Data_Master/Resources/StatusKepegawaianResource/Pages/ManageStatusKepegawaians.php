<?php

namespace App\Filament\Clusters\Data_Master\Resources\StatusKepegawaianResource\Pages;

use App\Filament\Clusters\Data_Master\Resources\StatusKepegawaianResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageStatusKepegawaians extends ManageRecords
{
    protected static string $resource = StatusKepegawaianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
