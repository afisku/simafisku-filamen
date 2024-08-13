<?php

namespace App\Filament\Clusters\Data_Master\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Ruangan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Clusters\Data_Master;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\Data_Master\Resources\RuanganResource\Pages;
use App\Filament\Clusters\Data_Master\Resources\RuanganResource\RelationManagers;
use Filament\Tables\Contracts\HasTable;
use stdClass;

class RuanganResource extends Resource
{
    protected static ?string $model = Ruangan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Data_Master::class;

    protected static ?string $navigationLabel = 'Ruangan';

    protected static ?string $slug = 'ruangan';

    protected static ?string $title = 'Ruangan ';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_ruangan'),
                Forms\Components\TextInput::make('kode_ruangan'),
                Forms\Components\FileUpload::make('foto')
                    ->image()
                    ->directory('ruangan')
                    ->imageEditor()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No')->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            (intval($livewire->getTableRecordsPerPage()) * (
                                intval($livewire->getTablePage()) - 1
                            ))
                        );
                    }
                )
                    ->extraHeaderAttributes([
                        'class' => 'w-8'
                    ])
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('nama_ruangan'),
                Tables\Columns\TextColumn::make('kode_ruangan')
                    ->alignCenter(),
                Tables\Columns\ImageColumn::make('foto')
                    ->alignCenter(),
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
                    ->modalHeading('Hapus Data Penduduk'),
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
            'index' => Pages\ManageRuangans::route('/'),
        ];
    }
}
