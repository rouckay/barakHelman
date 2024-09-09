<?php

namespace App\Filament\Resources\CustomerNumerahaResource\Pages;

use App\Filament\Resources\CustomerNumerahaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\HtmlString;

class ListCustomerNumerahas extends ListRecords
{
    protected static string $resource = CustomerNumerahaResource::class;
    protected static ?string $title = 'د نمرو د پلورلو برخه';

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
            Actions\CreateAction::make()
                ->label('د نوی نمری پلورل')
                ->extraAttributes([
                    'x-ref' => 'create_button', // Reference for the button
                ]),
        ];
    }
}
