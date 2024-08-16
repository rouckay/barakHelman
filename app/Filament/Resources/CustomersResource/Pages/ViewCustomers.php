<?php

namespace App\Filament\Resources\CustomersResource\Pages;

use App\Filament\Resources\CustomersResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCustomers extends ViewRecord
{
    protected static string $resource = CustomersResource::class;
    protected static ?string $title = 'د مشتری د معلوماتو کتل';


    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('تغیر کول'),
        ];
    }
}
