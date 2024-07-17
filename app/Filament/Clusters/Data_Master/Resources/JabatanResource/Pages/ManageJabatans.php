<?php

namespace App\Filament\Clusters\Data_Master\Resources\JabatanResource\Pages;

use App\Filament\Clusters\Data_Master\Resources\JabatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageJabatans extends ManageRecords
{
    protected static string $resource = JabatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
