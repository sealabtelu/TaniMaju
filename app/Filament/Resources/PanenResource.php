<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PanenResource\Pages;
use App\Filament\Resources\PanenResource\RelationManagers;
use App\Models\Panen;
use App\Models\Tanaman; // Import Tanaman model
use App\Models\Varietas; // Import Varietas model
use App\Models\Pupuk; // Import Pupuk model
use App\Models\Petani; // Import Petani model
use App\Models\Sawah; // Import Sawah model
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PanenResource extends Resource
{
    protected static ?string $model = Panen::class;

    protected static ?string $navigationIcon = 'healthicons-o-agriculture';

    protected static ?string $pluralLabel = 'Panen';

    protected static ?string $navigationGroup = 'Management';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggal_tanam')
                    ->label('Tanggal Tanam')
                    ->default(now())
                    ->displayFormat('dd/mm/yyyy')
                    ->required()
                    ->hidden()
                    ->afterStateUpdated(function (Forms\Components\DatePicker $component, $state) {
                        $component->state($state);
                    }),
                Forms\Components\Select::make('tanaman_id')
                    ->label('Tanaman')
                    ->relationship('tanaman', 'nama_tanaman')
                    ->required()
                    // ->searchable()
                    ->createOptionForm(fn (Form $form) => $form
                        ->schema([
                            Forms\Components\TextInput::make('nama_tanaman')
                                ->label('Tanaman')
                                ->required(),
                            Forms\Components\Textarea::make('deskripsi')
                                ->maxLength(500),
                        ])
                        ->model(Tanaman::class)
                    ),
                Forms\Components\Select::make('varietas_id')
                    ->label('Varietas')
                    ->relationship('varietas', 'nama_varietas')
                    ->required()
                    // ->searchable()
                    ->createOptionForm(fn (Form $form) => $form
                        ->schema([
                            Forms\Components\TextInput::make('nama_varietas')
                                ->label('Varietas')
                                ->required(),
                            Forms\Components\Textarea::make('deskripsi')
                                ->maxLength(500),
                        ])
                        ->model(Tanaman::class)
                    ),
                Forms\Components\Select::make('pupuk_id')
                    ->label('Pupuk')
                    ->relationship('pupuk', 'nama_pupuk')
                    ->required()
                    // ->searchable()
                    ->createOptionForm(fn (Form $form) => $form
                        ->schema([
                            Forms\Components\TextInput::make('nama_pupuk')
                                ->label('Pupuk')
                                ->required(),
                            Forms\Components\Textarea::make('jenis_pupuk')
                                ->maxLength(500)
                                ->required(),
                            Forms\Components\TextInput::make('stok_pupuk')
                                ->required()
                                ->numeric(),
                        ])
                        ->model(Tanaman::class)
                    ),
                Forms\Components\Select::make('petani_id')
                    ->relationship('Petani', 'nama_petani')
                    ->required()
                    // ->searchable()
                    ->createOptionForm(fn (Form $form) => $form
                        ->schema([
                            Forms\Components\TextInput::make('nama_petani')
                                ->label('Petani')
                                ->required(),
                            Forms\Components\Textarea::make('alamat_petani')
                                ->maxLength(500),
                            Forms\Components\TextInput::make('nomor_telepon')
                                ->numeric(),
                            Forms\Components\FileUpload::make('foto')
                                ->image()
                                ->directory('petani_fotos')
                                ->imageEditor()
                        ])
                        ->model(Tanaman::class)
                    ),
                Forms\Components\Select::make('sawah_id')
                ->relationship('Sawah', 'nama_sawah')
                ->required()
                // ->searchable()
                ->createOptionForm(fn (Form $form) => $form
                    ->schema([
                        Forms\Components\TextInput::make('nama_sawah')
                            ->label('Sawah')
                            ->required(),
                        Forms\Components\Textarea::make('lokasi')
                            ->maxLength(500),
                        Forms\Components\TextInput::make('luas_sawah')
                            ->label('Luas Sawah (m²)')
                            ->numeric(),
                    ])
                    ->model(Tanaman::class)
                    ),
                Forms\Components\DatePicker::make('tanggal_panen')
                    ->hidden(true)
                    ->default(now()),
                Forms\Components\Select::make('status_panen')
                    ->options([
                        'Sudah Panen' => 'Sudah Panen',
                        'Belum Panen' => 'Belum Panen',
                    ])
                    ->default('Belum Panen')
                    ->hidden(fn (string $record = null): bool => request()->routeIs('filament.panens.create'))
                    ->reactive()
                    ->afterStateUpdated(fn (string $state, callable $set) => $set('tanggal_panen', $state === 'Sudah Panen' ? now() : null))
                    ->hiddenOn('create'),
                Forms\Components\TextInput::make('jumlah')
                    ->hidden(fn (string $record = null): bool => request()->routeIs('filament.panens.create'))
                    ->afterStateUpdated(fn (string $state, callable $set) => $set('tanggal_panen', $state === 'Sudah Panen' ? now() : null))
                    ->hiddenOn('create'),
                Forms\Components\FileUpload::make('dokumentasi')
                    ->image()
                    ->directory('panen_fotos')
                    ->imageEditor()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Tanam')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('tanaman.nama_tanaman')
                    ->label('Tanaman')
                    ->sortable(),
                Tables\Columns\TextColumn::make('varietas.nama_varietas')
                    ->label('Varietas')
                    ->sortable(),
                Tables\Columns\TextColumn::make('pupuk.nama_pupuk')
                    ->label('Pupuk')
                    ->sortable(),
                Tables\Columns\TextColumn::make('petani.nama_petani')
                    ->label('Petani')
                    ->sortable(),
                Tables\Columns\TextColumn::make('sawah.nama_sawah')
                    ->label('Sawah')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Tanggal Panen')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                // Tables\Columns\TextColumn::make('panen.status_panen')
                //     ->searchable(),
                Tables\Columns\ImageColumn::make('dokumentasi')
                    ->label('Dokumentasi')
                    ->disk('public')
                    ->searchable(),
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
            'index' => Pages\ListPanens::route('/'),
            'create' => Pages\CreatePanen::route('/create'),
            'edit' => Pages\EditPanen::route('/{record}/edit'),
        ];
    }
}
