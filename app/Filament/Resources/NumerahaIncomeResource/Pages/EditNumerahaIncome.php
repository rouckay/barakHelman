<?php

namespace App\Filament\Resources\NumerahaIncomeResource\Pages;

use App\Filament\Resources\NumerahaIncomeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNumerahaIncome extends EditRecord
{
    protected static string $resource = NumerahaIncomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
