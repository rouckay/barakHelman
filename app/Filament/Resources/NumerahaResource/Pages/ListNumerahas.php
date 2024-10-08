<?php

namespace App\Filament\Resources\NumerahaResource\Pages;

use App\Filament\Resources\NumerahaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Imports\MyNumerahaImport;
use Filament\Forms\Components\Placeholder;

class ListNumerahas extends ListRecords
{
    protected static string $resource = NumerahaResource::class;
    protected static ?string $title = 'لیست د ټولو نمرو (ځمکو)';


    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->label('د مشتریانو لیست')
                ->url('customers')
                ->color('success'),
            Actions\ViewAction::make()
                ->label('پلورل شوی ځمکی')
                ->url('numerahas?tableFilters[پلورل%20شوی%20نمری%20(ځمکی)][value]=1')
                ->color('danger'),
            Actions\ViewAction::make()
                ->label('پاتی نمری (ځمکی)')
                ->url('numerahas?tableFilters[پلورل%20شوی%20نمری%20(ځمکی)][value]=0')
                ->color('warning'),
            // Actions\CreateAction::make()
            //     ->label('د نوی نمری پلورل')
            //     ->extraAttributes([
            //         'x-ref' => 'create_button', // Reference for the button
            //     ]),
            // \EightyNine\ExcelImport\ExcelImportAction::make()
            //     // ->color("primary")
            //     ->icon("heroicon-o-arrow-up-tray")
            //     // ->successMessage("Data imported successfully!")
            //     ->label('اپلوډ کړی')
            //     ->use(MyNumerahaImport::class),
            // Actions\CreateAction::make()
            //     ->label('نوی نمره ثبت کړی'), // Custom label for the "Add" button
        ];
    }
}
