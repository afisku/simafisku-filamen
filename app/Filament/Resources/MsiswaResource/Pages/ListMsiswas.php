<?php

namespace App\Filament\Resources\MsiswaResource\Pages;

use App\Filament\Resources\MsiswaResource;
use App\Models\Msiswa;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;

class ListMsiswas extends ListRecords
{
    protected static string $resource = MsiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getHeader(): ?View
    {
        $data = Actions\CreateAction::make();
        return View('filament.custome.upload-file', compact('data'));
    }

    public $file = '';
    public function save(){
        Msiswa::create([
            'nis' => '123',
            'nisn' => '1234',
            'nm_siswa' => 'edy saputra',
        ]);
    }
}
