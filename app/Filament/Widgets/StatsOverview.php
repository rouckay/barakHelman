<?php

namespace App\Filament\Widgets;

use App\Models\Customers;
use App\Models\Employees;
use App\Models\CustomerNumeraha;
use App\Models\Finance;
use App\Models\Numeraha;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '15s';
    protected static bool $isLazy = true;
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [
            Stat::make('مشتریان', Customers::count())
                ->description('ټولټال مشتریان په سیستم کې')
                ->descriptionIcon('heroicon-o-users')
                ->chart([1, 9, 5, 4, 7, 6, 7, 3, 9, 7, 1, 0])
                ->color('success')
            ,
            Stat::make('نمری (ځمکی)', Numeraha::count())
                ->description('ټولټال نمری (ځمکی)')
                ->descriptionIcon('heroicon-s-map')
                ->chart([2, 3, 8, 1, 7, 3, 5, 3, 6, 9, 7, 9])
                ->color('info')
            ,
            Stat::make('کارمندان', Employees::count())
                ->description('کارمندان لیست ')
                ->descriptionIcon('heroicon-o-user-circle')
                ->color('danger')
                ->chart([1, 5, 1, 4, 4, 8, 2, 7, 3, 2, 5, 9])
            ,
            Stat::make('مالی برخه', Finance::count())
                ->description('مالی برخی ټول پلورل شوی اجناس')
                ->descriptionIcon('heroicon-o-banknotes')
                ->color('info')
                ->chart([1, 4, 6, 4, 4, 2, 1, 4, 2, 2, 2, 5])
            ,
            Stat::make('اجناس', CustomerNumeraha::count())
                ->description('ټولټال اجناس ')
                ->descriptionIcon('heroicon-o-building-office-2')
                ->color('warning')
                ->chart([1, 2, 4, 5, 2, 8, 2, 7, 3, 2, 5, 2])
            ,
            Stat::make('نمری (ځمکی)', CustomerNumeraha::count())
                ->description('ټوټال پلورل شوی نمرو (ځمکو) ')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([1, 5, 1, 4, 4, 8, 2, 7, 3, 2, 5, 9])
            ,
        ];
    }
}
