<?php

namespace App\Filament\Widgets;

use App\Models\Numeraha;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class NumeraChart extends ChartWidget
{
    protected static ?string $heading = 'د نمرو (ځمکو) ثبت ';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = $this->getNumerahasPerMonth();

        return [
            'datasets' => [
                [
                    'label' => 'نمره (ځمکی) د میاشتی په اساس',
                    'data' => $data['NumerahasPerMonth'],
                ],
            ],
            'labels' => $data['months'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
    private function getNumerahasPerMonth(): array
    {
        $now = Carbon::now();

        $NumerahasPerMonth = [];
        $months = collect(range(1, 12))->map(function ($month) use ($now, &$NumerahasPerMonth) {
            $count = Numeraha::whereMonth('created_at', $month)->count();
            $NumerahasPerMonth[] = $count;
            return $now->month($month)->format('M');
        })->toArray();

        return [
            'NumerahasPerMonth' => $NumerahasPerMonth,
            'months' => $months
        ];
    }
}
