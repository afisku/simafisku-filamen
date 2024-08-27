<?php

namespace App\Filament\Clusters\Surat\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\KategoriSurat;
use App\Filament\Clusters\Surat;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\Surat\Resources\KategoriSuratResource\Pages;
use App\Filament\Clusters\Surat\Resources\KategoriSuratResource\RelationManagers;

class KategoriSuratResource extends Resource
{
    protected static ?string $model = KategoriSurat::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Surat::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode_kategori'),
                TextInput::make('kategori')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_kategori'),
                TextColumn::make('kategori')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageKategoriSurats::route('/'),
        ];
    }
}
