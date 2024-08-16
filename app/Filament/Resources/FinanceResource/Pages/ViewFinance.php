<?php

namespace App\Filament\Resources\FinanceResource\Pages;

use App\Filament\Resources\FinanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFinance extends ViewRecord
{
    protected static string $resource = FinanceResource::class;
    protected static ?string $title = 'د مالی حساب کتل';


    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('تغیر کول'),

        ];
    }
}
