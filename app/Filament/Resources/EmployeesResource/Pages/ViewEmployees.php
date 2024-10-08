<?php

namespace App\Filament\Resources\EmployeesResource\Pages;

use App\Filament\Resources\EmployeesResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEmployees extends ViewRecord
{
    protected static string $resource = EmployeesResource::class;
    protected static ?string $title = 'د یاد کارکوونکی معلومات کتل';


    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('تغیر کول'),

        ];
    }
}
