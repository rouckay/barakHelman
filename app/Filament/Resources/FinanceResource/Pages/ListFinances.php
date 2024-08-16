<?php

namespace App\Filament\Resources\FinanceResource\Pages;

use App\Filament\Resources\FinanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFinances extends ListRecords
{
    protected static string $resource = FinanceResource::class;
    protected static ?string $title = 'لیست د مالی حسابو';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('ثبت کول'),
        ];
    }
}
