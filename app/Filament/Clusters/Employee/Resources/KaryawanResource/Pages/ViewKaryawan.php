<?php

namespace App\Filament\Clusters\Employee\Resources\KaryawanResource\Pages;

use App\Filament\Clusters\Employee\Resources\KaryawanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewKaryawan extends ViewRecord
{
    protected static string $resource = KaryawanResource::class;

    protected static string $view = 'filament.resources.karyawans.view';
}
