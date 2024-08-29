<?php

namespace App\Filament\Resources\CustomerNumerahaResource\Pages;

use App\Filament\Resources\CustomerNumerahaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomerNumeraha extends EditRecord
{
    protected static string $resource = CustomerNumerahaResource::class;
    protected static ?string $title = 'تغیر په پلورل شوی نمره (ځمکه) کې';


    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()->label('کتل'),
            Actions\DeleteAction::make()->label('حذف کول'),
        ];
    }
}
