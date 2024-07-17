<?php

namespace App\Filament\Clusters\Data_Master\Resources;

use App\Filament\Clusters\Data_Master;
use App\Filament\Clusters\Data_Master\Resources\StatusKepegawaianResource\Pages;
use App\Filament\Clusters\Data_Master\Resources\StatusKepegawaianResource\RelationManagers;
use App\Models\StatusKepegawaian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StatusKepegawaianResource extends Resource
{
    protected static ?string $model = StatusKepegawaian::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Data_Master::class;

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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ManageStatusKepegawaians::route('/'),
        ];
    }
}
