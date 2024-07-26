<?php

namespace App\Filament\Resources\MarketsResource\Pages;

use App\Filament\Resources\MarketsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMarkets extends EditRecord
{
    protected static string $resource = MarketsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
