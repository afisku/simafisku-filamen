<?php

namespace App\Filament\Clusters\DataMasterSiswa\Resources\KondisiBelajarDirumahResource\Pages;

use App\Filament\Clusters\DataMasterSiswa\Resources\KondisiBelajarDirumahResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKondisiBelajarDirumahs extends ManageRecords
{
    protected static string $resource = KondisiBelajarDirumahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
