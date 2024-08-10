<?php

namespace App\Filament\Resources\EmployeesResource\Pages;

use App\Filament\Resources\EmployeesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmployees extends EditRecord
{
    protected static string $resource = EmployeesResource::class;

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
