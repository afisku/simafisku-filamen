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
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
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
                        if ($get('tgl_surat_keluar') != null && $get('kategori_surat_id') != null) {
                            $set('description', ($get('tgl_surat_keluar') . '/' . $get('kategori_surat_id')));
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
                        if ($get('tgl_surat_keluar') != null && $get('kategori_surat_id') != null) {
                            $set('description', ($get('tgl_surat_keluar') . '/' . $get('kategori_surat_id')));
                            }
                            }),
                TextInput::make('no_surat')
                ->label('Nomor Surat')
                ->columnSpanFull()
                ->disabled(),
                Textarea::make('description')
                        ->label("Descripsi Surat")
                        ->rows(5)
                        ->cols(20)
                        ->columnSpanFull()
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
