<?php

namespace App\Filament\Resources\CustomerNumerahaResource\Pages;

use App\Filament\Resources\CustomerNumerahaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCustomerNumeraha extends ViewRecord
{
    protected static string $resource = CustomerNumerahaResource::class;
    protected static ?string $title = 'د معاملې کتل';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('تغیر کول'),
        ];
    }
}
