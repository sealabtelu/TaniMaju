<?php

namespace App\Filament\Resources\SawahResource\Pages;

use App\Filament\Resources\SawahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSawah extends EditRecord
{
    protected static string $resource = SawahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
