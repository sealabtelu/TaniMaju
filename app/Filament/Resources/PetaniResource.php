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

    protected static ?string $navigationIcon = 'healthicons-f-agriculture-worker';

    protected static ?string $pluralLabel = 'Petani';

    protected static ?string $navigationGroup = 'Management';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_petani')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('alamat_petani')
                    ->maxLength(255),
                Forms\Components\TextInput::make('nomor_telepon')
                    ->maxLength(20),
                Forms\Components\FileUpload::make('foto')
                    ->image()
                    ->imageEditor()
                    ->directory('petani_fotos')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_petani')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('alamat_petani')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('nomor_telepon')->sortable()->searchable(),
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto Petani')
                    ->disk('public')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y H:i')->sortable(),
                
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
