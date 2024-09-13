<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VarietasResource\Pages;
use App\Filament\Resources\VarietasResource\RelationManagers;
use App\Models\Varietas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VarietasResource extends Resource
{
    protected static ?string $model = Varietas::class;

    protected static ?string $navigationIcon = 'phosphor-flower-duotone';

    protected static ?string $pluralLabel = 'Varietas';

    protected static ?string $navigationGroup = 'Management';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_varietas')
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
                Tables\Columns\TextColumn::make('nama_varietas')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('deskripsi')->sortable()->searchable(),
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
            'index' => Pages\ListVarietas::route('/'),
            'create' => Pages\CreateVarietas::route('/create'),
            'edit' => Pages\EditVarietas::route('/{record}/edit'),
        ];
    }
}
