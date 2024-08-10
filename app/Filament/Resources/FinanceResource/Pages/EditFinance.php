<?php

namespace App\Filament\Resources\FinanceResource\Pages;

use App\Filament\Resources\FinanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFinance extends EditRecord
{
    protected static string $resource = FinanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->label('کتل'),
            Actions\DeleteAction::make()
                ->label('حذف کول'),
        ];
    }
}
