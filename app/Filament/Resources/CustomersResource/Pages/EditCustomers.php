<?php

namespace App\Filament\Resources\CustomersResource\Pages;

use App\Filament\Resources\CustomersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomers extends EditRecord
{
    protected static string $resource = CustomersResource::class;
    protected static ?string $title = 'تغیرات راوړل د مشتری په معلوماتو کی';


    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->label('کتل'),
            Actions\DeleteAction::make()
                ->label('حذف کول'),
        ];
    }
}
