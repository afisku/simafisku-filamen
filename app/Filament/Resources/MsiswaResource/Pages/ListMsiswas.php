<?php

namespace App\Filament\Resources\MsiswaResource\Pages;

use Filament\Actions;
use App\Models\Msiswa;
use App\Imports\ImportDataSiswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\MsiswaResource;

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
        if ($this->file != ''){
            Excel::import(new ImportDataSiswa, $this->file);
        }
        // Msiswa::create([
        //     'nis' => '123',
        //     'nisn' => '1234',
        //     'nm_siswa' => 'edy saputra',
        // ]);
    }
}
