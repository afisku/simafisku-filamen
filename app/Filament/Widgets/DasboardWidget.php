<?php

namespace App\Filament\Widgets;

use App\Models\Karyawan;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DasboardWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Karyawan', Karyawan::count())
            ->description('Pendidik dan Tendik')
            ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
            ->color('primary'),
            Stat::make('Data Siswa', '321')
            ->description('All Data Siswa')
            ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
            ->color('primary'),
            Stat::make('Gedung', '12')
            ->description('Jumlah Gedung')
            ->descriptionIcon('heroicon-m-building-library', IconPosition::Before)
            ->color('primary'),
        ];
    }
}
