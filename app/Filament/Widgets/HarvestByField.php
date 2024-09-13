<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class HarvestByField extends ChartWidget
{
    protected static ?string $heading = 'Trend Hasil Panen';

    protected static ?string $pollingInterval = '360s';
    protected static ?int $sort = 2;

    protected function getType(): string
    {
        return 'line'; // Line chart
    }

    protected function getData(): array
    {
        // Fetch and prepare data
        $monthlyHarvest = DB::table('panens')
            ->select(DB::raw('DATE_FORMAT(updated_at, "%Y-%m") as month'), DB::raw('SUM(jumlah) as total'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Prepare labels and data
        $labels = $monthlyHarvest->pluck('month')->map(function($date) {
            return date('M Y', strtotime($date));
        })->toArray();

        $data = $monthlyHarvest->pluck('total')->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Hasil Panen Bulanan',
                    'data' => $data,
                    'borderColor' => '#42A5F5',
                    'backgroundColor' => 'rgba(66, 165, 245, 0.2)', // Optional, for area fill
                    'fill' => true, // Optional, to fill under the line
                ],
            ],
        ];
    }
}
