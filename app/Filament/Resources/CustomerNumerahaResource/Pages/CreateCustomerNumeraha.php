<?php

namespace App\Filament\Resources\CustomerNumerahaResource\Pages;

use App\Filament\Resources\CustomerNumerahaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomerNumeraha extends CreateRecord
{
    protected static string $resource = CustomerNumerahaResource::class;
    protected static ?string $title = 'نمره (ځمکه) خرڅه کړی';
    protected function getFooterActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
