<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengobatanLahanResource\Pages;
use App\Filament\Resources\PengobatanLahanResource\RelationManagers;
use App\Models\PengobatanLahan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use function Laravel\Prompts\search;

class PengobatanLahanResource extends Resource
{
    protected static ?string $navigationIcon = 'healthicons-o-health-data-security';

    protected static ?string $pluralLabel = 'Pengobatan Lahan';

    protected static ?string $navigationGroup = 'Pencatatan';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('petani_id')
                    ->relationship('petani', 'nama')
                    ->required(),
                Forms\Components\Select::make('lahan_id')
                    ->relationship('lahan', 'lokasi_lahan')
                    ->required(),
                Forms\Components\TextInput::make('jenis_pengobatan')
                    ->required(),
                Forms\Components\Textarea::make('deskripsi')
                    ->nullable(),
                Forms\Components\DatePicker::make('tanggal_pengobatan')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('petani.nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lahan.lokasi_lahan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_pengobatan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pengobatan')
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
            'index' => Pages\ListPengobatanLahans::route('/'),
            'create' => Pages\CreatePengobatanLahan::route('/create'),
            'edit' => Pages\EditPengobatanLahan::route('/{record}/edit'),
        ];
    }
}
