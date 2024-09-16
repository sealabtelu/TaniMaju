<?php

namespace App\Filament\Widgets;

use App\Models\Panen; // Import the Panen model
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;

class HarvestListData extends BaseWidget
{
    protected static ?string $heading = 'List Data Hasil Panen';

    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 5;

    public function table(Table $table): Table
    {
        return $table
            ->query(Panen::query()) // Use the correct Panen model query
            ->defaultSort('created_at', 'asc')
            ->columns([
                Tables\Columns\TextColumn::make('petani.nama_petani')->label('Petani'),
                Tables\Columns\TextColumn::make('tanaman.nama_tanaman')->label('Tanaman'),
                Tables\Columns\TextColumn::make('jumlah')->label('Jumlah')->suffix(' kg'),
                Tables\Columns\TextColumn::make('sawah.nama_sawah')->label('Sawah'),
                Tables\Columns\TextColumn::make('updated_at')->label('Tgl Panen')->dateTime(),
            ])
            ->actions([])
            ->headerActions([
                ExportAction::make()->exports([
                    ExcelExport::make()->withColumns([
                        Column::make('petani.nama_petani')->heading('Nama Petani'),
                        Column::make('tanaman.nama_tanaman')->heading('Tanaman'),
                        Column::make('jumlah')->heading('Jumlah'),
                        Column::make('sawah.nama_sawah')->heading('Sawah'),
                        Column::make('updated_at')->heading('Tgl Panen'),
                    ]),
                ])
            ]);
    }
}
