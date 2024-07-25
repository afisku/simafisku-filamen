<?php

namespace App\Filament\Clusters\Data_Master\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Ruangan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Clusters\Data_Master;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\Data_Master\Resources\RuanganResource\Pages;
use App\Filament\Clusters\Data_Master\Resources\RuanganResource\RelationManagers;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class RuanganResource extends Resource
{
    protected static ?string $model = Ruangan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Data_Master::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_ruangan'),
                TextInput::make('kode_ruangan'),
                FileUpload::make('foto')
                ->image()
                ->directory('ruangan')
                ->imageEditor()
                ->imageEditorViewportWidth('1920')
                ->imageEditorViewportHeight('1080'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_ruangan'),
                TextColumn::make('kode_ruangan'),
                ImageColumn::make('foto')
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
            'index' => Pages\ListRuangans::route('/'),
            'create' => Pages\CreateRuangan::route('/create'),
            'edit' => Pages\EditRuangan::route('/{record}/edit'),
        ];
    }
}
