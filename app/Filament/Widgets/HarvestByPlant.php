<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class HarvestByPlant extends ChartWidget
{
    protected static ?string $heading = 'Hasil Panen Berdasarkan Tanaman';
    protected static ?string $pollingInterval = '60s'; // Polling setiap 60 detik
    protected static ?int $sort = 2;

    protected function getType(): string
    {
        return 'bar'; // Menggunakan stacked bar chart
    }

    protected function getData(): array
    {
        // Ambil dan cache data hasil panen
        $harvestData = cache()->remember('harvest_data', 300, function () {
            return DB::table('hasil_panens')
                ->join('petanis', 'hasil_panens.petani_id', '=', 'petanis.id')
                ->join('tanamen', 'hasil_panens.tanaman_id', '=', 'tanamen.id')
                ->select('petanis.nama as nama_petani', 'tanamen.nama as nama_tanaman', DB::raw('SUM(hasil_panens.jumlah_hasil_panen) as total'))
                ->groupBy('petanis.nama', 'tanamen.nama')
                ->get();
        });

        $labels = [];
        $datasets = [];

        // Persiapan label dan dataset
        foreach ($harvestData as $data) {
            // Menambahkan nama petani ke label jika belum ada
            if (!in_array($data->nama_petani, $labels)) {
                $labels[] = $data->nama_petani;
            }

            // Menginisialisasi dataset untuk tanaman jika belum ada
            $tanamanName = $data->nama_tanaman;

            if (!isset($datasets[$tanamanName])) {
                $datasets[$tanamanName] = [
                    'label' => $tanamanName,
                    'data' => array_fill(0, count($labels), 0), // Isi data dengan 0 awalnya
                    'backgroundColor' => $this->getRandomColor(), // Warna random untuk tiap tanaman
                ];
            }

            // Mengisi data sesuai dengan index petani
            $petaniIndex = array_search($data->nama_petani, $labels);
            $datasets[$tanamanName]['data'][$petaniIndex] = $data->total;
        }

        return [
            'labels' => $labels,  // Label untuk nama petani
            'datasets' => array_values($datasets), // Konversi dataset ke array numerik
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

    // Fungsi untuk menghasilkan warna acak
    protected function getRandomColor(): string
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
}
