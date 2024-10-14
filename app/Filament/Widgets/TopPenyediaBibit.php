<?php

namespace App\Filament\Widgets;

use App\Models\Bibit;
use App\Models\PenyediaBibit;
use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;

class TopPenyediaBibit extends Widget
{
    protected static ?int $sort = 1;
    protected static string $view = 'filament.widgets.top-penyedia-bibit';
    protected static ?string $heading = 'Penyedia Bibit Terbaru';

    protected function getData(): array
    {
        return Bibit::join('tanamen', 'bibits.tanaman_id', '=', 'tanamen.id')
            ->select('bibits.nama_penyedia', 'tanamen.nama as nama_tanaman')
            ->orderBy('bibits.created_at', 'desc')
            ->take(5) // Limit to top 5 recent suppliers
            ->get()
            ->toArray();
    }

    public function render(): View
    {
        return view(static::$view, [
            'penyediaBibit' => $this->getData(),
            'heading' => static::$heading,
        ]);
    }
}
