<?php

namespace App\Filament\Resources\VarietasResource\Pages;

use App\Filament\Resources\VarietasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVarietas extends ListRecords
{
    protected static string $resource = VarietasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
