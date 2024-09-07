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
            ->descriptionIcon('heroicon-m-user-group', IconPosition::Before),
            // Stat::make('Bounce rate', '21%'),
            // Stat::make('Average time on page', '3:12'),
        ];
    }
}
