<?php

namespace App\Filament\Resources\NumerahaResource\Pages;

use App\Filament\Resources\NumerahaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNumerahas extends ListRecords
{
    protected static string $resource = NumerahaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \EightyNine\ExcelImport\ExcelImportAction::make()
                ->color("primary")
                ->label('اپلوډ کړی'),
            Actions\CreateAction::make()
                ->label('نوی نمره ثبت کړی'), // Custom label for the "Add" button
        ];
    }
}
