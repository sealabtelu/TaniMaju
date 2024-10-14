<?php

namespace App\Filament\Widgets;

use App\Models\HasilPanen;
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
            ->query(HasilPanen::query()) // Use the correct Panen model query
            ->defaultSort('created_at', 'asc')
            ->columns([
                Tables\Columns\TextColumn::make('created_at')->label('Tgl Panen')->dateTime(),
                Tables\Columns\TextColumn::make('status_penjualan')->label('Status Penjualan'),
                Tables\Columns\TextColumn::make('nama_pembeli')->label('Pembeli'),
                Tables\Columns\TextColumn::make('petani.nama')->label('Petani'),
                Tables\Columns\TextColumn::make('tanaman.nama')->label('Tanaman'),
                Tables\Columns\TextColumn::make('bibit.nama_penyedia')->label('Penyedia Bibit'),
                Tables\Columns\TextColumn::make('jumlah_hasil_panen')->label('Jumlah')->suffix(' kg'),
                Tables\Columns\TextColumn::make('pupuk.nama')->label('Pupuk'),
                Tables\Columns\TextColumn::make('lahan.lokasi_lahan')->label('Lokasi Lahan'), 
            ])
            ->actions([])
            ->headerActions([
                ExportAction::make()->exports([
                    ExcelExport::make()->withColumns([
                        Column::make('created_at')->heading('Tgl Panen'),
                        Column::make('status_penjualan')->heading('Status Penjualan'),
                        Column::make('nama_pembeli')->heading('Pembeli'),
                        Column::make('petani.nama')->heading('Petani'),
                        Column::make('tanaman.nama')->heading('Tanaman'),
                        Column::make('bibit.nama_penyedia')->heading('Penyedia Bibit'),
                        Column::make('jumlah_hasil_panen')->heading('Jumlah'),
                        Column::make('pupuk.nama')->heading(heading: 'Pupuk'),
                        Column::make('lahan.lokasi_lahan')->heading('Lokasi Lahan'),
                    ]),
                ])
            ]);
    }
}
