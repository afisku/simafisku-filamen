<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Agama;
use App\Models\Msiswa;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Pages\Actions;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\CreateAction;
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
                    ])->columns(2),
                ]),
                FormSection::make('Data Ortu / Wali Siswa')
                ->schema([
                    FormGrid::make()
                    ->schema([
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
                        // Field lainnya untuk data Ibu
                    ]),
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
                        // Field lainnya untuk data Wali
                    ])
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nis')
                    ->label('NIS')
                    ->searchable(),
                TextColumn::make('nisn')
                    ->label('NISN')
                    ->searchable(),
                TextColumn::make('nm_siswa')
                    ->label('Nama Lengkap')
                    ->searchable(),
                TextColumn::make('tempat_lahir')
                    ->label('Tempat Lahir'),
                TextColumn::make('tgl_lahir')
                    ->label('Tgl Lahir')
                    ->date('d F Y'),
                TextColumn::make('statusStuden.status')
                    ->label('Status')
                    ->badge()
                    ->sortable()
                    ->color(function (string $state): string {
                        return match ($state) {
                            'Aktif' => 'success',
                            'Nonaktif' => 'danger',
                            'Pindah' => 'primary',
                            'Lulus' => 'primary',
                            'Cuti' => 'warning',
                            'Drop Out' => 'danger',
                        };
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
