<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;
    protected static ?string $title = 'تغیرات په یاد کارمند کې';

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()->label('کتل'),
            Actions\DeleteAction::make()->label('حذف کول'),
        ];
    }
}
