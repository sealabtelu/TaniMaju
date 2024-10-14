<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LahanResource\Pages;
use App\Filament\Resources\LahanResource\RelationManagers;
use App\Models\Lahan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LahanResource extends Resource
{
    protected static ?string $model = Lahan::class;

    protected static ?string $navigationIcon = 'healthicons-o-forest';

    protected static ?string $pluralLabel = 'Lahan';

    protected static ?string $navigationGroup = 'Data Umum';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('petani_id')
                    ->relationship('petani', 'nama')
                    ->required(),
                Forms\Components\TextInput::make('lokasi_lahan')->required(),
                Forms\Components\TextInput::make('luas_lahan')->numeric(),
                Forms\Components\Select::make('tanaman_id')
                    ->relationship('tanaman', 'nama')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('petani.nama')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lokasi_lahan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('luas_lahan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanaman.nama')
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
            'index' => Pages\ListLahans::route('/'),
            'create' => Pages\CreateLahan::route('/create'),
            'edit' => Pages\EditLahan::route('/{record}/edit'),
        ];
    }
}
