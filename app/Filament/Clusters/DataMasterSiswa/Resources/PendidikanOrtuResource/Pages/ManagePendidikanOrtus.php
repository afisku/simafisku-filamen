<?php

namespace App\Filament\Clusters\DataMasterSiswa\Resources\PendidikanOrtuResource\Pages;

use App\Filament\Clusters\DataMasterSiswa\Resources\PendidikanOrtuResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePendidikanOrtus extends ManageRecords
{
    protected static string $resource = PendidikanOrtuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
