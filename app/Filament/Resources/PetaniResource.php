<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PetaniResource\Pages;
use App\Filament\Resources\PetaniResource\RelationManagers;
use App\Models\Petani;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PetaniResource extends Resource
{
    protected static ?string $model = Petani::class;

    protected static ?string $navigationIcon = 'healthicons-o-agriculture-worker';

    protected static ?string $pluralLabel = 'Petani';

    protected static ?string $navigationGroup = 'Data Umum';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required(),
                Forms\Components\TextInput::make('alamat'),
                Forms\Components\TextInput::make('nomor_kontak')
                    ->required(),
                Forms\Components\FileUpload::make('foto')
                    ->image()
                    ->imageEditor()
                    ->circleCropper()
                    ->directory('petani_fotos')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nomor_kontak')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ImageColumn::make('foto'),
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
            'index' => Pages\ListPetanis::route('/'),
            'create' => Pages\CreatePetani::route('/create'),
            'edit' => Pages\EditPetani::route('/{record}/edit'),
        ];
    }
}
