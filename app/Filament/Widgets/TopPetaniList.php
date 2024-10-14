<?php

namespace App\Filament\Widgets;

use App\Models\HasilPanen;
use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;

class TopPetaniList extends Widget
{

    protected static ?int $sort = 1;
    protected static ?string $heading = 'Top 5 Petani Berdasarkan Hasil Panen';

    protected function getData(): array
    {
        return HasilPanen::selectRaw('petanis.nama as nama_petani, SUM(jumlah_hasil_panen) as total_panen')
            ->join('petanis', 'hasil_panens.petani_id', '=', 'petanis.id')
            ->groupBy('petanis.nama')
            ->orderByDesc('total_panen')
            ->take(5)
            ->get()
            ->toArray();
    }

    protected function getViewData(): array
    {
        return [
            'petanis' => $this->getData(),
            'heading' => self::$heading, // Pass the heading to the view
        ];
    }

    public function render(): View
    {
        return view('filament.widgets.top-petani-list', $this->getViewData());
    }
}
