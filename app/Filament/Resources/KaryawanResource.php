<?php

namespace App\Filament\Resources;

use filament;
use stdClass;
use Filament\Forms;
use App\Models\Unit;
use Filament\Tables;
use App\Models\Karyawan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use App\Filament\Clusters\Employee;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\Storage;
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
use Filament\Forms\Components\Grid as FormGrid;
use App\Filament\Resources\KaryawanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section as FormSection;
use Filament\Infolists\Components\Grid as InfolistsGrid;
use App\Filament\Resources\KaryawanResource\RelationManagers;
use Filament\Infolists\Components\Section as InfolistSection;

class KaryawanResource extends Resource
{
    protected static ?string $model = Karyawan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Wizard::make([
                Wizard\Step::make('Biodata')
                    ->schema([
                        FormGrid::make()
                            ->schema([
                                TextInput::make('npy'),
                                TextInput::make('nik'),
                                TextInput::make('nama_lengkap')
                                ->placeholder('nama lengkap dan gelar'),
                            ])->columns(3),
                        FormGrid::make()
                            ->schema([
                                Select::make('jenis_kelamin')
                                    ->native(false)
                                    ->options([
                                        'L' => 'Laki-laki',
                                        'P' => 'Perempuan',
                                    ]),
                                TextInput::make('tempat_lahir'),
                                DatePicker::make('tanggal_lahir')
                                ->label('Tanggal Lahir')
                                ->placeholder('d/m/Y')
                                ->native(false)
                                ->displayFormat('d/m/Y'),
                            ])->columns(3),
                        Textarea::make('alamat')
                            ->autosize(),
                        TextInput::make('nomor_telepon'),
                        Select::make('user_id')
                            ->relationship('user', 'email')
                            ->searchable()
                            ->label('Email')
                            ->preload(),
                        FormGrid::make()
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
                            ->schema([
                                Select::make('status_karyawan_id')
                                    ->relationship('statusKaryawan', 'status')
                                    ->searchable()
                                    ->preload(),
                                FormGrid::make()
                                    ->schema([
                                        Select::make('posisi_kerja_id')
                                            ->relationship('posisiKerja', 'nama_posisi_kerja')
                                            ->searchable()
                                            ->preload(),
                                        Select::make('jabatan_id')
                                            ->relationship('jabatanPegawai', 'nama_jabatan')
                                            ->searchable()
                                            ->preload(),
                                        Select::make('unit_id')
                                            ->searchable()
                                            ->options(Unit::all()->pluck('nama_unit', 'id')),
                                        DatePicker::make('tanggal_mulai_bekerja'),
                                    ])->columns(4),
                            ]),

                        FormSection::make('Data Pendidikan')
                            ->schema([
                                FormGrid::make()
                                    ->schema([
                                        Select::make('pendidikan_terakhir_id')
                                            ->relationship('pendidikanTerakhir', 'nama_pendidikan_terakhir')
                                            ->searchable()
                                            ->preload(),
                                        
                                    ])->columns(1),
                                FormGrid::make()
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
                                FormGrid::make()
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
                                FormGrid::make()
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
                                FormGrid::make()
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
            TextColumn::make('No')
            ->state(
                static function (HasTable $livewire, stdClass $rowLoop): string {
                    return (string) (
                        $rowLoop->iteration +
                        ($livewire->getTableRecordsPerPage() * (
                            $livewire->getTablePage() - 1
                        ))
                    );
                }
            )->rowIndex(),
            TextColumn::make('nama_lengkap')
                ->description(fn(Karyawan $record): string => $record->npy)
                ->label('nama')
                ->sortable()
                ->searchable(),
            TextColumn::make('nomor_telepon')
                ->label('Kontak')
                ->description(fn(Karyawan $record): string => $record->user->email),
            TextColumn::make('jabatanPegawai.nama_jabatan')
                ->label('Jabatan'),
            ImageColumn::make('foto_karyawan')
                ->label('Profile')
                ->circular(),
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
            'index' => Pages\ListKaryawans::route('/'),
            'create' => Pages\CreateKaryawan::route('/create'),
            'edit' => Pages\EditKaryawan::route('/{record}/edit'),
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
                            InfolistsGrid::make(2)
                                ->schema([
                                    Group::make([

                                        TextEntry::make('npy'),
                                        TextEntry::make('nama_lengkap'),
                                        TextEntry::make('tempat_tanggal_lahir')
                                            ->label('Tempat, Tanggal Lahir'),
                                        TextEntry::make('jenis_kelamin_full')
                                            ->label('Jenis Kelamin'),
                                        TextEntry::make('alamat')
                                            ->label('Alamat Tinggal'),
                                        TextEntry::make('nomor_telepon'),
                                        TextEntry::make('created_at')
                                            ->badge()
                                            ->date('d F Y')
                                            ->color('success'),

                                    ]),
                                    Group::make([
                                        TextEntry::make('nik'),
                                        TextEntry::make('posisiKerja.nama_posisi_kerja')
                                            ->label('Bagian'),
                                        TextEntry::make('jabatanPegawai.nama_jabatan')
                                            ->label('Jabatan'),
                                        TextEntry::make('unitKerja.nama_unit')
                                            ->label('Unit'),
                                        TextEntry::make('statusKaryawan.status')
                                            ->label('Status Pegawai'),
                                        TextEntry::make('tanggal_mulai_bekerja')
                                            ->dateTime('d F Y')
                                            ->label('Mulai kerja'),
                                    ]),
                                ]),
                            ImageEntry::make('foto_karyawan')
                                ->hiddenLabel()
                                ->grow(false)
                                ->circular(),
                        ])->from('lg'),
                    ]),
                InfolistSection::make('Data Pendidikan')
                    ->schema([
                        Split::make([
                            InfolistsGrid::make(3)
                                ->schema([
                                    Group::make([
                                        TextEntry::make('pendidikanTerakhir.nama_pendidikan_terakhir'),
                                        TextEntry::make('jurusan'),
                                    ]),
                                    Group::make([
                                        TextEntry::make('institusi_pendidikan'),
                                        TextEntry::make('tahun_lulus'),
                                    ]),
                                    Group::make([
                                        ImageEntry::make('scan_ktp')
                                            ->defaultImageUrl(url('/images/placeholder.png'))
                                    ]),
                                ])
                        ])

                    ])->collapsible(),

            ]);
    }
}
