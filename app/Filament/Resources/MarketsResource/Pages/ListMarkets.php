<?php

namespace App\Filament\Resources\MarketsResource\Pages;

use App\Filament\Resources\MarketsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMarkets extends ListRecords
{
    protected static string $resource = MarketsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
