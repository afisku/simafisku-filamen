<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Forms;
use Filament\Tables;
use App\Models\Agama;
use App\Models\Msiswa;
use Filament\Forms\Form;
use App\Models\JarakRumah;
use Filament\Tables\Table;
use App\Models\StatusSiswa;
use App\Models\TahunAjaran;
use Filament\Pages\Actions;
use App\Models\Transportasi;
use App\Models\PekerjaanOrtu;
use App\Models\PendidikanOrtu;
use App\Models\PenghasilanOrtu;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Select;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Grid as FormGrid;
use App\Filament\Resources\MsiswaResource\Pages;
use Filament\Forms\Components\Section as FormSection;

class MsiswaResource extends Resource
{
    protected static ?string $model = Msiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FormSection::make('Biodata Siswa')
                ->schema([
                    FormGrid::make()
                    ->schema([
                        TextInput::make('nm_siswa')
                            ->label('Nama Siswa')
                            ->required()
                            ->placeholder('Masukkan nama lengkap siswa')
                            ->maxLength(255),
                        TextInput::make('nis')
                            ->label('NIS')
                            ->numeric()
                            ->minLength(7)
                            ->maxLength(7)
                            ->required()
                            ->placeholder('Masukkan NIS (7 digit)')
                            ->helperText('Wajib 7 digit angka.'),
                        TextInput::make('nisn')
                            ->label('NISN')
                            ->numeric()
                            ->minLength(10)
                            ->maxLength(10)
                            ->required()
                            ->placeholder('Masukkan NISN (10 digit)'),
                        TextInput::make('nik')
                            ->label('NIK')
                            ->numeric()
                            ->minLength(16)
                            ->maxLength(16)
                            ->required()
                            ->placeholder('Masukkan NIK (16 digit)'),
                        Select::make('jk')
                            ->label('Jenis Kelamin')
                            ->options([
                                'L' => 'Laki-Laki',
                                'P' => 'Perempuan',
                            ])
                            ->required(),
                        Select::make('agama_id')
                            ->label('Agama')
                            ->searchable()
                            ->options(Agama::all()->pluck('agama', 'id'))
                            ->required(),
                        Select::make('yatim_piatu')
                            ->label('Yatim Piatu')
                            ->options([
                                'Yes' => 'Ya',
                                'No' => 'Tidak',
                            ])
                            ->required(),
                        Textarea::make('penyakit')
                            ->label('Riwayat Penyakit')
                            ->autosize()
                            ->placeholder('Masukkan penyakit yang pernah diderita'),
                        TextInput::make('jumlah_saudara')
                            ->label('Jumlah Saudara')
                            ->numeric()
                            ->required(),
                        TextInput::make('anak_ke')
                            ->label('Anak Ke')
                            ->numeric()
                            ->required(),
                        TextInput::make('dari_bersaudara')
                            ->label('Dari Bersaudara')
                            ->numeric()
                            ->required(),
                    ])->columns(3),
                    FormGrid::make()
                    ->schema([
                        TextInput::make('tempat_lahir')
                            ->label('Tempat Lahir')
                            ->required(),
                        DatePicker::make('tgl_lahir')
                        ->label('Tanggal Lahir')
                        ->required(),
                    ])->columns(2),
                    FormGrid::make()
                    ->schema([
                        TextInput::make('asal_sekolah')
                            ->label('Asal Sekolah')
                            ->required(),
                        TextInput::make('nspn')
                            ->label('NSPN')
                            ->numeric()
                            ->maxLength(10),
                        Select::make('status_siswa_id')
                            ->label('Status')
                            ->options(StatusSiswa::all()->pluck('status', 'id'))
                            ->required(),
                        Select::make('tahun_ajaran_id')
                            ->label('Tahun Ajaran')
                            ->options(TahunAjaran::all()->pluck('ta', 'id'))
                            ->required(),
                    ])->columns(2),
                    FormSection::make('Alamat Asal')
                    ->schema([
                        TextInput::make('provinsi_asal')
                            ->label('Provinsi Asal')
                            ->required(),
                        TextInput::make('kabkota_asal')
                            ->label('Kabupaten/Kota Asal')
                            ->required(),
                        TextInput::make('kecamatan_asal')
                            ->label('Kecamatan Asal')
                            ->required(),
                        TextInput::make('desalurah_asal')
                            ->label('Desa/Lurah Asal')
                            ->required(),
                        Textarea::make('alamat_asal')
                            ->label('Alamat Lengkap')
                            ->required(),
                        TextInput::make('rt_asal')
                            ->label('RT')
                            ->numeric()
                            ->required(),
                        TextInput::make('rw_asal')
                            ->label('RW')
                            ->numeric()
                            ->required(),
                        TextInput::make('kodepos_asal')
                            ->label('Kode Pos')
                            ->numeric()
                            ->required(),
                    ])->columns(3),

                FormSection::make('Informasi Lainnya')
                    ->schema([
                        Select::make('transportasi_id')
                            ->label('Transportasi')
                            ->options(Transportasi::all()->pluck('kendaraan', 'id'))
                            ->required(),
                        Select::make('jarak_rumah_id')
                            ->label('Jarak Rumah')
                            ->options(JarakRumah::all()->pluck('jarak', 'id'))
                            ->required(),
                        FileUpload::make('foto')
                            ->label('Foto Siswa')
                            ->image()
                            ->directory('foto-siswa'),
                        FileUpload::make('doc_mutasi')
                            ->label('Dokumen Mutasi')
                            ->directory('dokumen-mutasi'),
                    ])->columns(2),
                ]),
                FormSection::make('Data Ortu / Wali Siswa')
                ->schema([
                    FormGrid::make()
                    ->schema([
                        TextInput::make('nomor_kk')
                            ->label('Nomor KK')
                            ->numeric()
                            ->minLength(16)
                            ->maxLength(16)
                            ->required(),
                        TextInput::make('nm_ayah')
                            ->label('Nama Ayah')
                            ->required(),
                        TextInput::make('nik_ayah')
                            ->label('NIK Ayah')
                            ->numeric()
                            ->minLength(16)
                            ->maxLength(16)
                            ->required(),
                        TextInput::make('tahun_lahir_ayah')
                            ->label('Tahun Lahir Ayah')
                            ->numeric()
                            ->required(),
                        Select::make('pendidikan_ayah_id')
                            ->label('Pendidikan Ayah')
                            ->options(PendidikanOrtu::all()->pluck('pendidikan', 'id'))
                            ->required(),
                        Select::make('pekerjaan_ayah_id')
                            ->label('Pekerjaan Ayah')
                            ->options(pekerjaanOrtu::all()->pluck('pekerjaan', 'id'))
                            ->required(),
                        Select::make('penghasilan_ayah_id')
                            ->label('Penghasilan Ayah')
                            ->options(PenghasilanOrtu::all()->pluck('penghasilan', 'id'))
                            ->required(),
                        TextInput::make('nohp_ayah')
                            ->label('Nomor HP Ayah')
                            ->tel(),
                        // Field lainnya seperti pendidikan, pekerjaan, penghasilan Ayah
                    ])->columns(3),
                    FormGrid::make()
                    ->schema([
                        TextInput::make('nm_ibu')
                            ->label('Nama Ibu')
                            ->required(),
                        TextInput::make('nik_ibu')
                            ->label('NIK Ibu')
                            ->numeric()
                            ->minLength(16)
                            ->maxLength(16)
                            ->required(),
                        TextInput::make('tahun_lahir_ibu')
                            ->label('Tahun Lahir Ibu')
                            ->numeric()
                            ->required(),
                        Select::make('pendidikan_ibu_id')
                            ->label('Pendidikan Ibu')
                            ->options(PendidikanOrtu::all()->pluck('pendidikan', 'id'))
                            ->required(),
                        Select::make('pekerjaan_ibu_id')
                            ->label('Pekerjaan Ibu')
                            ->options(pekerjaanOrtu::all()->pluck('pekerjaan', 'id'))
                            ->required(),
                        Select::make('penghasilan_ibu_id')
                            ->label('Penghasilan Ibu')
                            ->options(PenghasilanOrtu::all()->pluck('penghasilan', 'id'))
                            ->required(),
                        TextInput::make('nohp_ibu')
                            ->label('Nomor HP Ibu')
                            ->tel(),
                    ])->columns(3),
                    FormGrid::make()
                    ->schema([
                        TextInput::make('nm_wali')
                            ->label('Nama Wali'),
                        TextInput::make('nik_wali')
                            ->label('NIK Wali')
                            ->numeric()
                            ->minLength(16)
                            ->maxLength(16),
                        TextInput::make('tahun_lahir_wali')
                            ->label('Tahun Lahir Wali')
                            ->numeric(),
                        Select::make('pendidikan_wali_id')
                            ->label('Pendidikan Wali')
                            ->options(PendidikanOrtu::all()->pluck('pendidikan', 'id')),
                        Select::make('pekerjaan_wali_id')
                            ->label('Pekerjaan Wali')
                            ->options(pekerjaanOrtu::all()->pluck('pekerjaan', 'id')),
                        Select::make('penghasilan_wali_id')
                            ->label('Penghasilan Wali')
                            ->options(PenghasilanOrtu::all()->pluck('penghasilan', 'id')),
                        TextInput::make('nohp_wali')
                            ->label('Nomor HP Wali')
                            ->tel(),
                    ])->columns(3)
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordAction(null)
            ->recordUrl(null)
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

                // Split::make([
                    ImageColumn::make('foto')
                    ->circular(),                    
                        // Panel::make([
                        TextColumn::make('nm_siswa')
                        ->weight(FontWeight::Bold)
                        ->searchable()
                        ->sortable()
                        ->description(fn (Msiswa $record): string => $record->nisn),
                        TextColumn::make('nis'),
                        // ->formatStateUsing(fn (string $state): HtmlString => new HtmlString("<small>NIS: {$state}</small>")),
                        // TextColumn::make('nisn'),
                        // ->formatStateUsing(fn (string $state): HtmlString => new HtmlString("<small>NISN: {$state}</small>")),
                    // ]),
                    ColumnGroup::make('Tempat, Tanggal Lahir', [
                    TextColumn::make('tempat_lahir')
                        ->label('Tempat Lahir'),
                    TextColumn::make('tgl_lahir')
                        ->label('Tgl Lahir')
                        ->date('d F Y'),
                    ]),
                        TextColumn::make('jk')
                        ->label('JK'),
                        ColumnGroup::make('Nama Orang Tua', [
                            TextColumn::make('ortuSiswa.nm_ayah')
                                ->label('Ayah'),
                            TextColumn::make('ortuSiswa.nm_ibu')
                                ->label('Ibu'),
                        ]),
                        TextColumn::make('statusSiswa.status')
                    ->label('Status')
                    ->badge()
                    ->sortable()
                    ->color(function (string $state): string {
                        return match ($state) {
                            'Aktif' => 'success',
                            'Mutasi Masuk' => 'danger',
                            'Mutasi Keluar' => 'primary',
                            'DO' => 'primary',
                            'Cuti' => 'warning',
                            'Lulus' => 'danger',
                            'Mengundurkan Diri' => 'danger',
                        };
                    }),
                        TextColumn::make('alamat_asal')
                        ->label('Alamat')
                        ->words(10)
                        ->toggleable(isToggledHiddenByDefault: true),
                        ColumnGroup::make('Pekerjaan', [
                            TextColumn::make('ortuSiswa.pekerjaanAyah.kode')->label('Ayah')->toggleable(isToggledHiddenByDefault: true),
                            TextColumn::make('ortuSiswa.pekerjaanIbu.kode')->label('Ibu')->toggleable(isToggledHiddenByDefault: true),
                        ]),
                        ColumnGroup::make('Pekndidikan', [
                            TextColumn::make('ortuSiswa.pendidikanAyah.kode')->label('Ayah')->toggleable(isToggledHiddenByDefault: true),
                            TextColumn::make('ortuSiswa.pendidikanIbu.kode')->label('Ibu')->toggleable(isToggledHiddenByDefault: true),
                        ]),
                        ColumnGroup::make('Penghasilan', [
                            TextColumn::make('ortuSiswa.penghasilanAyah.kode')->label('Ayah')->toggleable(isToggledHiddenByDefault: true),
                            TextColumn::make('ortuSiswa.penghasilanIbu.kode')->label('Ibu')->toggleable(isToggledHiddenByDefault: true),
                        ]),
                    
                    // ]), 
                
                                // ImageColumn::make('foto'),
                                // TextColumn::make('nm_siswa')
                                // ->weight(FontWeight::Bold),
                                // Stack::make([
                                //     TextColumn::make('nis')
                                //     ->formatStateUsing(fn (string $state): HtmlString => new HtmlString("<small>NIS: {$state}</small>")),
                                //     TextColumn::make('nisn')
                                //     ->formatStateUsing(fn (string $state): HtmlString => new HtmlString("<small>NISN: {$state}</small>")),
                                //     ])->visibleFrom('md'),
                                //     Grid::make(['md' => 2]) // Mengatur grid untuk layar menengah ke atas dengan 2 kolom
                                //     ->schema([
                                //         
                                //     ]),
                               
                
                // TextColumn::make('nm_siswa')
                // ->description(fn (Msiswa $record): string => $record->nis)
                // ->description(fn (Msiswa $record): string => $record->nisn),
                // TextColumn::make('nis')
                //     ->label('NIS')
                //     ->searchable(),
                // TextColumn::make('nisn')
                //     ->label('NISN')
                //     ->searchable(),
                // TextColumn::make('nm_siswa')
                //     ->label('Nama Lengkap')
                //     ->searchable(),
                // TextColumn::make('tempat_lahir')
                //     ->label('Tempat Lahir'),
                // TextColumn::make('tgl_lahir')
                //     ->label('Tgl Lahir')
                //     ->date('d F Y'),
                // TextColumn::make('statusSiswa.status')
                //     ->label('Status')
                //     ->badge()
                //     ->sortable()
                //     ->color(function (string $state): string {
                //         return match ($state) {
                //             'Aktif' => 'success',
                //             'Mutasi Masuk' => 'danger',
                //             'Mutasi Keluar' => 'primary',
                //             'DO' => 'primary',
                //             'Cuti' => 'warning',
                //             'Lulus' => 'danger',
                //             'Mengundurkan Diri' => 'danger',
                //         };
                //     }),
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
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->headerActions([
                CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMsiswas::route('/'),
            'create' => Pages\CreateMsiswa::route('/create'),
            'edit' => Pages\EditMsiswa::route('/{record}/edit'),
        ];
    }
}
