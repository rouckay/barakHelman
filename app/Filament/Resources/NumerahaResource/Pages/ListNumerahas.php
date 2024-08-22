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
                ->label('لیستونه د مشتریانو')
                ->url('customers')
                ->color('success'),
            Actions\ViewAction::make()
                ->label('د نمرو (ځمکو) پلورل')
                ->url('customer-numerahas')
                ->color('info'),
            Actions\ViewAction::make()
                ->label('پلورل شوی ځمکی')
                ->url('customer-numerahas')
                ->color('danger'),
            Actions\ViewAction::make()
                ->label('پاتی نمری (ځمکی) چی ندی پلورل شوی.')
                ->url('customer-numerahas')
                ->color('warning'),
            \EightyNine\ExcelImport\ExcelImportAction::make()
                // ->color("primary")
                ->icon("heroicon-o-arrow-up-tray")
                // ->successMessage("Data imported successfully!")
                ->label('اپلوډ کړی')
                ->use(MyNumerahaImport::class),
            Actions\CreateAction::make()
                ->label('نوی نمره ثبت کړی'), // Custom label for the "Add" button
        ];
    }
}
