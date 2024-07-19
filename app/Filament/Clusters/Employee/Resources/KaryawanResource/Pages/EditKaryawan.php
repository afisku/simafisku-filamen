<?php

namespace App\Filament\Clusters\Employee\Resources\KaryawanResource\Pages;

use App\Filament\Clusters\Employee\Resources\KaryawanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKaryawan extends EditRecord
{
    protected static string $resource = KaryawanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
