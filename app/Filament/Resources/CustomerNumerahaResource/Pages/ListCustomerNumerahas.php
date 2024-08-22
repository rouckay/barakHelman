<?php

namespace App\Filament\Resources\CustomerNumerahaResource\Pages;

use App\Filament\Resources\CustomerNumerahaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomerNumerahas extends ListRecords
{
    protected static string $resource = CustomerNumerahaResource::class;
    protected static ?string $title = 'معاملات';

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->label('لیستونه د مشتریانو')
                ->url('customers')
                ->color('success'),
            Actions\ViewAction::make()
                ->label('د نمرو (ځمکو) پلورل')
                ->url('customer-numerahas')
                ->color('info'),
            Actions\ViewAction::make()
                ->label('پلورل شوی ځمکی')
                ->url('customer-numerahas')
                ->color('danger'),
            Actions\ViewAction::make()
                ->label('پاتی نمری (ځمکی) چی ندی پلورل شوی.')
                ->url('customer-numerahas')
                ->color('warning'),
            Actions\CreateAction::make()
                ->label(' نوی معامله ثبت کړی')
            ,
        ];
    }
}
