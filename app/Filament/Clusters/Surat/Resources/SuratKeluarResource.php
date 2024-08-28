<?php

namespace App\Filament\Clusters\Surat\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\SuratKeluar;
use App\Models\KategoriSurat;
use App\Filament\Clusters\Surat;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\Surat\Resources\SuratKeluarResource\Pages;
use App\Filament\Clusters\Surat\Resources\SuratKeluarResource\RelationManagers;

class SuratKeluarResource extends Resource
{
    protected static ?string $model = SuratKeluar::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Surat::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('perihal'),
                TextInput::make('tujuan_pengiriman'),
                DatePicker::make('tgl_surat_keluar')
                        ->label('Tanggal Surat Keluar')
                        ->placeholder('d/m/Y')
                        ->native(false)
                        ->displayFormat('d/m/Y')
                        ->live()
->afterStateUpdated(function (callable $get, callable $set) {
    // Pastikan tanggal surat keluar dan kategori surat terisi
    if ($get('tgl_surat_keluar') != null && $get('kategori_surat_id') != null) {

        // Ambil data tanggal surat
        $tanggalSurat = $get('tgl_surat_keluar');
        $tahun = date('Y', strtotime($tanggalSurat));
        $bulan = date('n', strtotime($tanggalSurat));

        // Konversi bulan ke angka Romawi menggunakan array
        $bulanRomawiMap = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 
            6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX', 
            10 => 'X', 11 => 'XI', 12 => 'XII'
        ];
        
        $bulanRomawi = $bulanRomawiMap[$bulan] ?? '';

        // Ambil kategori surat berdasarkan ID yang dipilih
        $kategoriSurat = \App\Models\KategoriSurat::find($get('kategori_surat_id'));
        $kodeKategori = $kategoriSurat->kode_kategori ?? '';

        // Dapatkan nomor urut terakhir dari surat keluar dengan tahun dan bulan yang sama
        $lastSurat = \App\Models\SuratKeluar::whereYear('tgl_surat_keluar', $tahun)
                        ->whereMonth('tgl_surat_keluar', $bulan)
                        ->latest('id')
                        ->first();

        // Jika ada surat sebelumnya, ambil nomor urut terakhir, jika tidak mulai dari 1
        $nomorUrut = $lastSurat ? intval(substr($lastSurat->no_surat, 0, 3)) + 1 : 1;
        $nomorUrutFormatted = str_pad($nomorUrut, 3, '0', STR_PAD_LEFT);

        // Gabungkan semua komponen untuk nomor surat
        $noSurat = "$nomorUrutFormatted/$kodeKategori/SMPIT-AFISKU/$bulanRomawi/$tahun";

        // Set nilai `no_surat` otomatis di form
        $set('no_surat', $noSurat);
    }
}),
                Select::make('kategori_surat_id')
                        ->label('Kategori Surat')
                        ->placeholder('Pilih Kategori')
                        ->searchable()
                        ->preload()
                        ->options(KategoriSurat::all()->pluck('kategori', 'id'))
                        ->live()
->afterStateUpdated(function (callable $get, callable $set) {
    // Pastikan tanggal surat keluar dan kategori surat terisi
    if ($get('tgl_surat_keluar') != null && $get('kategori_surat_id') != null) {

        // Ambil data tanggal surat
        $tanggalSurat = $get('tgl_surat_keluar');
        $tahun = date('Y', strtotime($tanggalSurat));
        $bulan = date('n', strtotime($tanggalSurat));

        // Konversi bulan ke angka Romawi menggunakan array
        $bulanRomawiMap = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 
            6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX', 
            10 => 'X', 11 => 'XI', 12 => 'XII'
        ];
        
        $bulanRomawi = $bulanRomawiMap[$bulan] ?? '';

        // Ambil kategori surat berdasarkan ID yang dipilih
        $kategoriSurat = \App\Models\KategoriSurat::find($get('kategori_surat_id'));
        $kodeKategori = $kategoriSurat->kode_kategori ?? '';

        // Dapatkan nomor urut terakhir dari surat keluar dengan tahun dan bulan yang sama
        $lastSurat = \App\Models\SuratKeluar::whereYear('tgl_surat_keluar', $tahun)
                        ->whereMonth('tgl_surat_keluar', $bulan)
                        ->latest('id')
                        ->first();

        // Jika ada surat sebelumnya, ambil nomor urut terakhir, jika tidak mulai dari 1
        $nomorUrut = $lastSurat ? intval(substr($lastSurat->no_surat, 0, 3)) + 1 : 1;
        $nomorUrutFormatted = str_pad($nomorUrut, 3, '0', STR_PAD_LEFT);

        // Gabungkan semua komponen untuk nomor surat
        $noSurat = "$nomorUrutFormatted/$kodeKategori/SMPIT-AFISKU/$bulanRomawi/$tahun";

        // Set nilai `no_surat` otomatis di form
        $set('no_surat', $noSurat);
    }
}),
                TextInput::make('no_surat')
                ->label('Nomor Surat')
                ->columnSpanFull()
                ->disabledOn('create')
                ->live()
                ->rules([
                    'required',
                    'string',
                    'max:255',
                    'unique:surat_keluar,no_surat' // Validasi unik
                ]),
                FileUpload::make('dokumen')
                        ->label('Arsip')
                        ->disk('public')
                        ->acceptedFileTypes(['application/pdf'])    // hanya menerima pdf
                        ->minSize(50)                               // minimum 50kb
                        ->maxSize(20480)                            // maximum 20MB
                        ->visibility('private')
                        ->directory('dokumen_surat_keluar')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no_surat')
                    ->searchable(),
                TextColumn::make('perihal'),
                TextColumn::make('kategoriSurat.kategori')
                    ->label('Kategori')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('tgl_surat_keluar')
                    ->date('d/m/Y')
                    ->label('Tgl Surat'),
                TextColumn::make('tujuan_pengiriman')
                    ->label('Tujuan')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('user.karyawan.nama_lengkap')
                    ->label('Dibuat')
                    ->toggleable(isToggledHiddenByDefault: true),
                
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->iconButton()
                    ->color('primary')
                    ->icon('heroicon-m-eye'),
                Tables\Actions\EditAction::make()
                    ->iconButton()
                    ->color('warning')
                    ->icon('heroicon-m-pencil-square'),
                Tables\Actions\DeleteAction::make()
                    ->iconButton()
                    ->color('danger')
                    ->icon('heroicon-m-trash')
                    ->modalHeading('Hapus Data Karyawan'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSuratKeluars::route('/'),
            'create' => Pages\CreateSuratKeluar::route('/create'),
            'edit' => Pages\EditSuratKeluar::route('/{record}/edit'),
        ];
    }
}
