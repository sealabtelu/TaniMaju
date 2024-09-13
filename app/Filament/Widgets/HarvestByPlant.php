<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class HarvestByPlant extends ChartWidget
{
    protected static ?string $heading = 'Hasil Panen Berdasarkan Tanaman';

    protected static ?string $pollingInterval = '360s';
    protected static ?int $sort = 2;

    protected function getType(): string
    {
        return 'bar'; // Stacked bar chart
    }

    protected function getData(): array
    {
        $harvestData = cache()->remember('harvest_data', 60, function () {
            return DB::table('panens')
                ->join('sawahs', 'panens.sawah_id', '=', 'sawahs.id')
                ->join('tanamen', 'panens.tanaman_id', '=', 'tanamen.id')
                ->select('sawahs.nama_sawah', 'tanamen.nama_tanaman', DB::raw('SUM(panens.jumlah) as total'))
                ->groupBy('sawahs.nama_sawah', 'tanamen.nama_tanaman')
                ->get();
        });

        // Get unique sawah names and plant names
        $labels = $harvestData->pluck('nama_sawah')->unique()->toArray();
        $plantNames = $harvestData->pluck('nama_tanaman')->unique()->toArray();

        // Prepare datasets for each plant type
        $datasets = array_map(function ($tanaman) use ($harvestData, $labels) {
            return [
                'label' => $tanaman,
                'data' => array_map(function ($label) use ($harvestData, $tanaman) {
                    $total = $harvestData->where('nama_sawah', $label)->where('nama_tanaman', $tanaman)->first()->total ?? 0;
                    return $total;
                }, $labels),
                'backgroundColor' => $this->getRandomColor(), // Optional: Add color for each dataset
            ];
        }, $plantNames);

        return [
            'labels' => $labels,
            'datasets' => $datasets,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'x' => [
                    'stacked' => true,
                    'beginAtZero' => true,
                ],
                'y' => [
                    'stacked' => true,
                    'beginAtZero' => true,
                ],
            ],
        ];
    }

    // Helper function to generate random colors for the datasets
    protected function getRandomColor(): string
    {
        $colors = ['#FF6384', '#36A2EB', '#FFCE56', '#FF5733', '#DAF7A6'];
        return $colors[array_rand($colors)];
    }
}
