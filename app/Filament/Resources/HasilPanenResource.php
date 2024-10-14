<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HasilPanenResource\Pages;
use App\Filament\Resources\HasilPanenResource\RelationManagers;
use App\Models\HasilPanen;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HasilPanenResource extends Resource
{
    protected static ?string $model = HasilPanen::class;

    protected static ?string $navigationIcon = 'healthicons-o-agriculture';

    protected static ?string $pluralLabel = 'Panen';

    protected static ?string $navigationGroup = 'Pencatatan';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('petani_id')
                    ->relationship('petani', 'nama')
                    ->createOptionForm(fn (Form $form) => $form
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
                        ])
                    )
                    ->required(),
                Forms\Components\Select::make('pupuk_id')
                    ->relationship('pupuk', 'nama')
                    ->createOptionForm(fn (Form $form) => $form
                        ->schema([
                            Forms\Components\TextInput::make('nama')->required(),
                            Forms\Components\Select::make('jenis')->options([
                                'Organik' => 'Organik',
                                'Non-organik' => 'Non-organik',
                            ])->required(),
                        ])
                    )
                    ->required(),
                Forms\Components\Select::make('tanaman_id')
                    ->relationship('tanaman', 'nama')
                    ->createOptionForm(fn (Form $form) => $form
                        ->schema([
                            Forms\Components\TextInput::make('nama')->required(),
                            Forms\Components\Select::make('pupuk_id')
                                ->relationship('pupuk', 'nama')
                                ->required(),
                        ])
                    )
                    ->required(),
                Forms\Components\Select::make('bibit_id')
                    ->label(label: 'Nama Penyedia Bibit')
                    ->relationship('bibit', 'nama_penyedia')
                    ->createOptionForm(fn (Form $form) => $form
                        ->schema([
                            Forms\Components\Select::make('tanaman_id')
                                ->relationship('tanaman', 'nama')
                                ->required(),
                            Forms\Components\TextInput::make('sumber')
                                ->required(),
                            Forms\Components\TextInput::make('nama_penyedia')
                                ->required(),
                        ])
                    )
                    ->required(),
                Forms\Components\Select::make('lahan_id')
                    ->relationship('lahan', 'lokasi_lahan')
                    ->createOptionForm(fn (Form $form) => $form
                        ->schema([
                            Forms\Components\Select::make('petani_id')
                                ->relationship('petani', 'nama')
                                ->required(),
                            Forms\Components\TextInput::make('lokasi_lahan')->required(),
                            Forms\Components\TextInput::make('luas_lahan')->numeric(),
                            Forms\Components\Select::make('tanaman_id')
                                ->relationship('tanaman', 'nama')
                                ->required(),
                        ])
                    )
                    ->required(),
                Forms\Components\TextInput::make('jumlah_hasil_panen')
                    ->numeric()
                    ->required(),
                Forms\Components\Select::make('status_penjualan')->options([
                    'Terjual' => 'Terjual',
                    'Tersedia' => 'Tersedia',
                ])->required(),
                Forms\Components\TextInput::make('nama_pembeli')->nullable(),
                Forms\Components\Textarea::make('deskripsi')->nullable(),
                Forms\Components\FileUpload::make('foto')
                    ->image()
                    ->imageEditor()
                    ->directory('panen_fotos')
                    ->nullable(), // Field 'foto'
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Panen')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('petani.nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lahan.lokasi_lahan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bibit.nama_penyedia')
                    ->label(label: 'Nama Penyedia Bibit')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanaman.nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pupuk.nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_hasil_panen')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_penjualan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_pembeli')
                    ->searchable(),
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
            'index' => Pages\ListHasilPanens::route('/'),
            'create' => Pages\CreateHasilPanen::route('/create'),
            'edit' => Pages\EditHasilPanen::route('/{record}/edit'),
        ];
    }
}
