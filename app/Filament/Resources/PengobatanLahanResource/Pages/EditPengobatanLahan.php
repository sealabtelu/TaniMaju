<?php

namespace App\Filament\Resources\PengobatanLahanResource\Pages;

use App\Filament\Resources\PengobatanLahanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengobatanLahan extends EditRecord
{
    protected static string $resource = PengobatanLahanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
