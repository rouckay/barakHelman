<?php

namespace App\Filament\Resources\NumerahaResource\Pages;

use App\Filament\Resources\NumerahaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewNumeraha extends ViewRecord
{
    protected static string $resource = NumerahaResource::class;
    protected static ?string $title = 'د یاد نمره (ځمکی) کتل';


    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('تغیر کول'),
        ];
    }
}
