<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;
    protected static ?string $title = 'لیست د ټولو کارمندانو';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('نوی کارمند ثبت کړی'),
        ];
    }
}
