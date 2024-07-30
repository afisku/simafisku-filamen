<?php

namespace App\Filament\Clusters\Employee\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Karyawan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use App\Filament\Clusters\Employee;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Split;
use Filament\Support\Enums\IconPosition;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section as FormSection;
use Filament\Infolists\Components\Section as InfolistSection;
use App\Filament\Clusters\Employee\Resources\KaryawanResource\Pages;
use App\Filament\Clusters\Employee\Resources\KaryawanResource\RelationManagers;

class KaryawanResource extends Resource
{
    protected static ?string $model = Karyawan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Data Karyawan';

    protected static ?string $cluster = Employee::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Biodata')
                        ->schema([
                            Grid::make()
                            ->schema([
                                TextInput::make('npy'),
                                TextInput::make('nik'),
                                TextInput::make('nama_lengkap'),
                            ])->columns(3),
                            Grid::make()
                            ->schema([
                                Select::make('jenis_kelamin')
                                ->options([
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                                ]),               
                                TextInput::make('tempat_lahir'),
                                DatePicker::make('tanggal_lahir'),
                            ])->columns(3),  
                                Textarea::make('alamat')
                                ->autosize(),
                                TextInput::make('nomor_telepon'),
                                Grid::make()
                                ->schema([
                                TextInput::make('nama_pasangan'),
                                TextInput::make('jumlah_anak')
                                ->numeric(),
                                TextInput::make('kontak_darurat'),
                                ])->columns(3),
                                
                        ]),
                    Wizard\Step::make('Data Tambahan')
                        ->schema([
                            FormSection::make('Data Kerja')
                            ->description('meluputi jabatan, posisi unit dan tanggal mulai bekerja di Al-Fityan')
                            ->schema([
                                Select::make('status_karyawan_id')
                                ->relationship('statusKaryawan', 'status')
                                ->searchable()
                                ->preload(),
                            Grid::make()
                            ->schema([
                                Select::make('posisi_kerja_id')
                                ->relationship('posisiKerja', 'nama_posisi_kerja')
                                ->searchable()
                                ->preload(),
                                Select::make('jabatan_id')
                                ->relationship('jabatan', 'nama_jabatan')
                                ->searchable()
                                ->preload(),
                                Select::make('unit_id')
                                ->relationship('unit', 'nama_unit')
                                ->searchable()
                                ->preload(),
                                DatePicker::make('tanggal_mulai_bekerja'),
                            ])->columns(4),
                            ]),

                            FormSection::make('Data Pendidikan')
                            ->description('Data pendidikan terakhir, jurusan, Institusi pendidikan dan pelatihan pengembangan diri yang pernah diikuti')
                            ->schema([
                                Grid::make()
                                ->schema([
                                    Select::make('pendidikan_terakhir_id')
                                    ->relationship('pendidikanTerakhir','nama_pendidikan_terakhir')
                                    ->searchable()
                                    ->preload(),
                                    Select::make('gelar_pendidikan_id')
                                    ->relationship('gelarPendidikan','nama_gelar_pendidikan')
                                    ->searchable()
                                    ->preload(),
                                ])->columns(2),
                            Grid::make()
                            ->schema([
                                
                                TextInput::make('institusi_pendidikan')
                                ->label('nama Institusi Pendidikan'),
                                TextInput::make('jurusan'),
                                TextInput::make('tahun_lulus')
                                ->numeric(),
                            ])->columns(3)
                            ])
                            
                        ]),
                    Wizard\Step::make('Dokumen')
                    ->description('seluruh dokument wajib discan rapi')
                        ->schema([
                            FormSection::make('Dokumen Biodata Diri')
                            ->schema([
                                Grid::make()
                                ->schema([
                                    FileUpload::make('foto_karyawan')
                                    ->imageEditor()
                                    ->directory('fotoKaryawan'),
                                    FileUpload::make('scan_ktp')
                                    ->imageEditor()
                                    ->directory('ktp'),
                                    FileUpload::make('scan_kk')
                                    ->imageEditor()
                                    ->directory('kk'),
                                ])->columns(3),
                            ]),

                            FormSection::make('Dokumen Ijazah & Sertifikat')
                            ->schema([
                                Grid::make()
                                ->schema([
                                    FileUpload::make('scan_ijazah_terakhir')
                                    ->imageEditor()
                                    ->directory('ijazah'),
                                    FileUpload::make('scan_sertifikat_penghargaan')
                                    ->imageEditor()
                                    ->directory('penghargaan'),
                                    FileUpload::make('sertifikat_prestasi')
                                    ->imageEditor()
                                    ->directory('prestasi'),
                                ])->columns(3),
                            ]),

                            FormSection::make('Dokumen SK')
                            ->schema([
                                Grid::make()
                                ->schema([
                                    FileUpload::make('scan_sk_yayasan')
                                    ->imageEditor()
                                    ->directory('sk_yayasan'),
                                    FileUpload::make('scan_sk_mengajar')
                                    ->imageEditor()
                                    ->directory('sk_mengajar'),
                                ])->columns(2),
                            ]),
                        ]),
                ])
                
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_lengkap')
                ->description(fn (Karyawan $record): string => $record->npy)
                ->label('nama')
                ->sortable(),
                TextColumn::make('jabatan.nama_jabatan'),
                TextColumn::make('nomor_telepon')
                ->icon('heroicon-m-phone')
                ->iconPosition(IconPosition::Before)
                ->iconColor('primary')
                ->label('No.HP'),
                ImageColumn::make('foto_karyawan')
                ->label('Profile')
                ->circular(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListKaryawans::route('/'),
            'create' => Pages\CreateKaryawan::route('/create'),
            'edit' => Pages\EditKaryawan::route('/{record}/edit'),
            'view' => Pages\ViewKaryawan::route('/{record}/view'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->schema([           
            // ImageEntry::make('foto_karyawan')
            // ->height(60)
            // ->circular(),
            
            InfolistSection::make()
            ->schema([
                Split::make([
                    Grid::make(2)
                    ->schema([
                        Group::make([
                        
                                        TextEntry::make('npy'),
                                        TextEntry::make('nama_lengkap'),
                                        TextEntry::make('created_at')
                                            ->badge()
                                            ->date()
                                            ->color('success'),
                    
                        ])
                        ])

                    ])
                ])
        ]);
}
}
