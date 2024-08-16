<?php

namespace App\Filament\Resources\CustomerNumerahaResource\Pages;

use App\Filament\Resources\CustomerNumerahaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomerNumerahas extends ListRecords
{
    protected static string $resource = CustomerNumerahaResource::class;
    protected static ?string $title = 'معاملات';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label(' نوی معامله ثبت کړی')
            ,
        ];
    }
}
