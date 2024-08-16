<?php

namespace App\Filament\Resources\MarketsResource\Pages;

use App\Filament\Resources\MarketsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMarkets extends ViewRecord
{
    protected static string $resource = MarketsResource::class;
    protected static ?string $title = 'د یاد مارکیټ معلومات کتل';


    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('تغیر کول'), // Custom label for the "Add" button
        ];
    }
}
