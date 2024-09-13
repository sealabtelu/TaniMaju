<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TanamanResource\Pages;
use App\Filament\Resources\TanamanResource\RelationManagers;
use App\Models\Tanaman;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TanamanResource extends Resource
{
    protected static ?string $model = Tanaman::class;

    protected static ?string $navigationIcon = 'phosphor-plant-duotone';

    protected static ?string $pluralLabel = 'Tanaman';

    protected static ?string $navigationGroup = 'Management';

    protected static ?int $navigationSort = 2;


    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('nama_tanaman')
                ->required()
                ->maxLength(255),
            Forms\Components\Textarea::make('deskripsi')
                ->maxLength(500),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_tanaman')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('deskripsi')->sortable()->searchable(),
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
            'index' => Pages\ListTanamen::route('/'),
            'create' => Pages\CreateTanaman::route('/create'),
            'edit' => Pages\EditTanaman::route('/{record}/edit'),
        ];
    }
}
