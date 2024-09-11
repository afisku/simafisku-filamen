<?php

namespace App\Filament\Clusters\DataMasterSiswa\Resources;

use App\Filament\Clusters\DataMasterSiswa;
use App\Filament\Clusters\DataMasterSiswa\Resources\PenghasilanOrtuResource\Pages;
use App\Filament\Clusters\DataMasterSiswa\Resources\PenghasilanOrtuResource\RelationManagers;
use App\Models\PenghasilanOrtu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenghasilanOrtuResource extends Resource
{
    protected static ?string $model = PenghasilanOrtu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = DataMasterSiswa::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
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
            'index' => Pages\ManagePenghasilanOrtus::route('/'),
        ];
    }
}
