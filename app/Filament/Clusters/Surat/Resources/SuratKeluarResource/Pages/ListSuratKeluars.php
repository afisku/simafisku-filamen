<?php

namespace App\Filament\Clusters\Surat\Resources\SuratKeluarResource\Pages;

use App\Filament\Clusters\Surat\Resources\SuratKeluarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSuratKeluars extends ListRecords
{
    protected static string $resource = SuratKeluarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('exportSuratKeluar')
                ->label('EXPORT SURAT KELUAR')
                ->color('gray')
                // ->visible(auth()->user()->hasRole('superadmin'))
                ->url(fn(): string => route('surat.keluar.export.excel')),
            Actions\CreateAction::make(),
        ];
    }
}
