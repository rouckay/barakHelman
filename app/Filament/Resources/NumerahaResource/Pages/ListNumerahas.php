<?php

namespace App\Filament\Resources\NumerahaResource\Pages;

use App\Filament\Resources\NumerahaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Imports\MyNumerahaImport;

class ListNumerahas extends ListRecords
{
    protected static string $resource = NumerahaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \EightyNine\ExcelImport\ExcelImportAction::make()
                ->color("primary")
                ->icon("heroicon-o-arrow-up-tray")
                // ->successMessage("Data imported successfully!")
                ->label('اپلوډ کړی')
                // ->failureMessage("Failed to import data.")
                ->use(MyNumerahaImport::class),
            Actions\CreateAction::make()
                ->label('نوی نمره ثبت کړی'), // Custom label for the "Add" button
        ];
    }
}
