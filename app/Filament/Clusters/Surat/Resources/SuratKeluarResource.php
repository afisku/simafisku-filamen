<?php

namespace App\Filament\Clusters\Surat\Resources;

use stdClass;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\SuratKeluar;
use App\Models\TahunAjaran;
use App\Models\KategoriSurat;
use App\Filament\Clusters\Surat;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Filters\Indicator;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Exports\SuratKeluarExporter;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\HeaderActionsPosition;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\Surat\Resources\SuratKeluarResource\Pages;
use App\Filament\Clusters\Surat\Resources\SuratKeluarResource\RelationManagers;

class SuratKeluarResource extends Resource
{
    protected static ?string $model = SuratKeluar::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';

    protected static ?string $navigationLabel = 'Surat Keluar';

    

    protected static ?string $cluster = Surat::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                        TextInput::make('perihal')
                        ->required(),
                        TextInput::make('tujuan_pengiriman')
                        ->required(),
                        DatePicker::make('tgl_surat_keluar')
                            ->label('Tanggal Surat Keluar')
                            ->required()
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
                                ->required()
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
                                ->required()
                                ->columnSpanFull(),
                                
                                FileUpload::make('dokumen')
                                ->label('Arsip')
                                ->visibility('private')
                                ->directory('dokumen_surat_keluar')
                                ->columnSpanFull(),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            ))
                        );
                    }
                )->rowIndex(),
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
                TextColumn::make('dibuatOleh.karyawan.nama_lengkap')
                    ->label('Dibuat')
                    ->toggleable(isToggledHiddenByDefault: true),
                
            ])
            ->filters([
            SelectFilter::make('th_ajaran_id')
                ->options(TahunAjaran::all()->pluck('ta','id'))
                ->label('Tahun Ajaran'),
                Filter::make('tgl_surat_keluar')
                ->form([
                    DatePicker::make('created_from'),
                    DatePicker::make('created_until'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('tgl_surat_keluar', '>=', $date),
                        )
                        ->when(
                            $data['created_until'],
                            fn (Builder $query, $date): Builder => $query->whereDate('tgl_surat_keluar', '<=', $date),
                        );
                })
            ->indicateUsing(function (array $data): array {
                $indicators = [];
                if ($data['created_from'] ?? null) {
                    $indicators['created_from'] = Indicator::make('Created from ' . Carbon::parse($data['created_from'])->toFormattedDateString())
                        ->removeField('from');
                }
        
                if ($data['created_until'] ?? null) {
                    $indicators[] = Indicator::make('Created until ' . Carbon::parse($data['created_until'])->toFormattedDateString())
                        ->removeField('created_until');
                }
        
                return $indicators;
            })
        ])
        ->actions([
            Tables\Actions\ViewAction::make()
                ->iconButton()
                ->color('primary')
                ->icon('heroicon-m-eye'),
                Tables\Actions\EditAction::make()
                    ->iconButton()
                    ->color('warning')
                    ->icon('heroicon-m-pencil-square')
                    ->disabled(fn ($record) => true),
                Tables\Actions\DeleteAction::make()
                    ->iconButton()
                    ->color('danger')
                    ->icon('heroicon-m-trash')
                    ->modalHeading('Hapus Data Karyawan'),
                // Tambahkan tombol download
            Tables\Actions\Action::make('download')
            ->iconButton()
            ->icon('heroicon-m-document-text')
            ->color('gray')
            ->label('Download')
            ->url(fn (SuratKeluar $record) => route('download-dokumen', $record))
            ->visible(fn (SuratKeluar $record) => $record->dokumen != null) // Tombol hanya muncul jika ada file dokumen
            ])
            // ->headerActions([
            //     ExportAction::make()
            //     ->exporter(SuratKeluarExporter::class)
            //     ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                // ExportBulkAction::make()
                // ->exporter(SuratKeluarExporter::class)
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
