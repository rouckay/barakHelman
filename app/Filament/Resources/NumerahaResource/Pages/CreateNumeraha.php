<?php

namespace App\Filament\Resources\NumerahaResource\Pages;

use App\Filament\Resources\NumerahaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use App\Models\Numeraha;
use Filament\Notifications\Notification;

class CreateNumeraha extends CreateRecord
{
    protected static string $resource = NumerahaResource::class;
    // protected function afterCreate(Numeraha $numeraha): void
    // {
    //     Notification::make()
    //         ->title('نمره(ځمکه) اضافه شوه')
    //         ->sendToDatabase($numeraha->numero_number)
    //     ;
    // }
}
