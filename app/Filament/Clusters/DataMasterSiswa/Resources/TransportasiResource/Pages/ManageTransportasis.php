<?php

namespace App\Filament\Clusters\DataMasterSiswa\Resources\TransportasiResource\Pages;

use App\Filament\Clusters\DataMasterSiswa\Resources\TransportasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTransportasis extends ManageRecords
{
    protected static string $resource = TransportasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
