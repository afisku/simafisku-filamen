<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Msiswa;
use Filament\Forms\Form;
use App\Models\AgamaOrtu;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Grid as FormGrid;
use App\Filament\Resources\MsiswaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section as FormSection;
use App\Filament\Resources\MsiswaResource\RelationManagers;

class MsiswaResource extends Resource
{
    protected static ?string $model = Msiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FormSection::make('Biodata siswa')
                ->schema([
                        FormGrid::make()
                        ->schema([
                            TextInput::make('nm_siswa'),
                            TextInput::make('nis')
                            ->numeric()
                            ->minLength(7)
                            ->maxLength(7),
                            TextInput::make('nisn')
                            ->numeric()
                            ->minLength(10)
                            ->maxLength(10),
                            TextInput::make('nik')
                            ->numeric()
                            ->minLength(16)
                            ->maxLength(16),
                            Select::make('jk')
                            ->native(false)
                            ->options([
                                'L' => 'Laki - Laki',
                                'P' => 'Perempuan',
                            ]),
                            Select::make('agama_id')
                            ->searchable()
                            ->label('Agama')
                            ->options(AgamaOrtu::all()->pluck('agama', 'id')),
                            Select::make('yatim_piatu')
                                        ->native(false)
                                        ->options([
                                            'Yes' => 'Yes',
                                            'No' => 'No',
                                        ]),
                            Textarea::make('penyakit')
                            ->autosize()
                            ->placeholder('penyakit yang pernah diderita'),
                            TextInput::make('jumlah_saudara'),
                            TextInput::make('anak_ke'),
                            TextInput::make('dari_bersaudara'),
                        ])->columns(3),
                        FormGrid::make()
                        ->schema([
                            TextInput::make('tempat_lahir'),
                            TextInput::make('tgl_lahir'),
                        ])->columns(2),
                        FormGrid::make()
                        ->schema([
                            TextInput::make('asal_sekolah'),
                            TextInput::make('nspn'),
                        ])->columns(2),
                        FormGrid::make()
                        ->schema([
                            TextInput::make('provinsi_asal'),
                            TextInput::make('kabkota_asal'),
                            TextInput::make('kecamatan_asal'),
                            TextInput::make('desalurah_asal'),
                            TextInput::make('alamat_asal'),
                            TextInput::make('rt_asal'),
                            TextInput::make('rw_asal'),
                            TextInput::make('kodepos_asal'),
                            TextInput::make('transportasi_id'),
                            TextInput::make('jarak_rumah_id'),
                            TextInput::make('kabkota_asal'),
                        ])->columns(3),
                        FormGrid::make()
                        ->schema([
                            TextInput::make('foto'),
                            TextInput::make('doc_mutasi'),
                        ])->columns(2),
                        FormGrid::make()
                        ->schema([
                            TextInput::make('status_siswa_id'),
                            TextInput::make('tahun_ajaran_id'),
                        ])->columns(2)
                ]),
                FormSection::make('Data Ortu / Wali Siswa')
                ->schema([
                    FormGrid::make()
                        ->schema([
                            TextInput::make('nm_ayah'),
                            TextInput::make('nik_ayah'),
                            TextInput::make('tahun_lahir_ayah'),
                            TextInput::make('pendidikan_ayah_id'),
                            TextInput::make('pekerjaan_ayah_id'),
                            TextInput::make('penghasilan_ayah_id'),
                            TextInput::make('nohp_ayah'),
                        ])->columns(3),
                        FormGrid::make()
                        ->schema([
                            TextInput::make('nm_ibu'),
                            TextInput::make('nik_ibu'),
                            TextInput::make('tahun_lahir_ibu'),
                            TextInput::make('pendidikan_ibu_id'),
                            TextInput::make('pekerjaan_ibu_id'),
                            TextInput::make('penghasilan_ibu_id'),
                            TextInput::make('nohp_ibu'),
                        ]),
                        FormGrid::make()
                        ->schema([
                            TextInput::make('nm_wali'),
                            TextInput::make('nik_wali'),
                            TextInput::make('tahun_lahir_wali'),
                            TextInput::make('pendidikan_wali_id'),
                            TextInput::make('pekerjaan_wali_id'),
                            TextInput::make('penghasilan_wali_id'),
                            TextInput::make('nohp_wali'),
                        ])
                ])
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
            // ->headerActions([
            //     Tables\Actions\CreateAction::make(),
            // ]);

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
            'index' => Pages\ListMsiswas::route('/'),
            'create' => Pages\CreateMsiswa::route('/create'),
            'edit' => Pages\EditMsiswa::route('/{record}/edit'),
        ];
    }
}
