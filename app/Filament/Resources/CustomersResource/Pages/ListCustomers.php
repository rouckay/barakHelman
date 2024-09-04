<?php

namespace App\Filament\Resources\CustomersResource\Pages;

use App\Filament\Resources\CustomersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomers extends ListRecords
{
    protected static string $resource = CustomersResource::class;
    protected static ?string $title = 'د مشتریانو لیست';


    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make()
            //     ->label('ثبت کول'),
        ];
    }
}
