<?php

namespace App\Filament\Resources\MarketsResource\Pages;

use App\Filament\Resources\MarketsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMarkets extends CreateRecord
{
    protected static string $resource = MarketsResource::class;
    protected static ?string $title = 'ثبت نوی مارکیټ';

}
