<?php

namespace App\Filament\Resources\NumerahaIncomeResource\Pages;

use App\Filament\Resources\NumerahaIncomeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNumerahaIncomes extends ListRecords
{
    protected static string $resource = NumerahaIncomeResource::class;
    protected static ?string $title = 'د نمری ټولټال عواید';

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
