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
            ->description('pendidik dan tendik')
            ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
            ->color('primary'),
            Stat::make('Data Siswa', '321')
            ->description('all data siswa')
            ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
            ->color('primary'),
            Stat::make('Aset', '12')
            ->description('jumlah aset dan infentaris')
            ->descriptionIcon('heroicon-m-building-library', IconPosition::Before)
            ->color('primary'),
        ];
    }
}
