<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SawahResource\Pages;
use App\Filament\Resources\SawahResource\RelationManagers;
use App\Models\Sawah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SawahResource extends Resource
{
    protected static ?string $model = Sawah::class;

    protected static ?string $navigationIcon = 'phosphor-farm-duotone';

    protected static ?string $pluralLabel = 'Sawah';

    protected static ?string $navigationGroup = 'Management';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_sawah')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('lokasi_sawah')
                    ->maxLength(255),
                Forms\Components\TextInput::make('luas_sawah')
                    ->label('Luas Sawah (m²)')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_sawah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lokasi_sawah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('luas_sawah')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListSawahs::route('/'),
            'create' => Pages\CreateSawah::route('/create'),
            'edit' => Pages\EditSawah::route('/{record}/edit'),
        ];
    }
}
