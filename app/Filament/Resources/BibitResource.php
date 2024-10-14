<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BibitResource\Pages;
use App\Filament\Resources\BibitResource\RelationManagers;
use App\Models\Bibit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BibitResource extends Resource
{
    protected static ?string $model = Bibit::class;

    protected static ?string $navigationIcon = 'ri-seedling-line';

    protected static ?string $pluralLabel = 'Bibit';

    protected static ?string $navigationGroup = 'Data Umum';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tanaman_id')
                    ->relationship('tanaman', 'nama')
                    ->required(),
                Forms\Components\TextInput::make('sumber')
                    ->required(),
                Forms\Components\TextInput::make('nama_penyedia')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanaman.nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sumber')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_penyedia')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pemberian')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
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
            'index' => Pages\ListBibits::route('/'),
            'create' => Pages\CreateBibit::route('/create'),
            'edit' => Pages\EditBibit::route('/{record}/edit'),
        ];
    }
}
