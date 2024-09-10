<?php

namespace App\Filament\Exports;

use App\Models\SuratKeluar;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class SuratKeluarExporter extends Exporter
{
    protected static ?string $model = SuratKeluar::class;

    public static function getColumns(): array
    {
        return [
            ExportColom::make('no_surat'),
            ExportColom::make('kategori_surat_id'),
            ExportColom::make('tgl_surat_keluar'),
            ExportColom::make('perihal'),
            ExportColom::make('tujuan_pengiriman'),
            ExportColom::make('dibuat_oleh'),
            ExportColom::make('th_ajaran_id')
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your surat keluar export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
