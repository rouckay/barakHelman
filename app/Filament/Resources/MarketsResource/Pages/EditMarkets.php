<?php

namespace App\Filament\Resources\MarketsResource\Pages;

use App\Filament\Resources\MarketsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMarkets extends EditRecord
{
    protected static string $resource = MarketsResource::class;
    protected static ?string $title = 'تغیرات په یاد مارکیټ کی ';


    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()->label('کتل'),
            Actions\DeleteAction::make()->label('حذف کول'),
        ];
    }
}
