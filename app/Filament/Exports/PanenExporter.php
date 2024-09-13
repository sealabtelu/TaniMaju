<?php

namespace App\Filament\Exports;

use App\Models\Panen;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class PanenExporter extends Exporter
{
    protected static ?string $model = Panen::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('petani.nama_petani'),
            ExportColumn::make('tanaman.nama_tanaman'),
            ExportColumn::make('jumlah'),
            ExportColumn::make('updated_at')->label('Tanggal Panen'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your panen export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
