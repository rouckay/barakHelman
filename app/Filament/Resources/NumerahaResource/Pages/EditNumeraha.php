<?php

namespace App\Filament\Resources\NumerahaResource\Pages;

use App\Filament\Resources\NumerahaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNumeraha extends EditRecord
{
    protected static string $resource = NumerahaResource::class;
    protected static ?string $title = 'تغیرات په یاد نمره (ځمکه) کې';


    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->label('کتل'),
            // Actions\DeleteAction::make()
            //     ->label('حذف کول'),
        ];
    }
}
