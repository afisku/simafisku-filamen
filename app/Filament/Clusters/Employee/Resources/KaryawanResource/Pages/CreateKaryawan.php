<?php

namespace App\Filament\Clusters\Employee\Resources\KaryawanResource\Pages;

use App\Filament\Clusters\Employee\Resources\KaryawanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKaryawan extends CreateRecord
{
    protected static string $resource = KaryawanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}
