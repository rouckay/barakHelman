<?php

namespace App\Filament\Widgets;

use App\Models\Numeraha;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class NumeraChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $data = $this->getNumerahasPerMonth();

        return [
            'datasets' => [
                [
                    'lable' => '',
                    'data' => $data['NumerahaPerMonth']
                ]
            ],
            'labels' => $data['months']
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
        $months = collect(range(1, 12))->map(function ($month) use ($now, $NumerahasPerMonth) {
            $count = Numeraha::whereMonth('created_at', Carbon::parse($now->month($month)->format('Y-m')))->count();
            $NumerahasPerMonth[] = $count;
            return $now->month($month)->format('M');
        })->toArray();
        return [
            'NumerahaPerMonth' => $NumerahasPerMonth,
            'months' => $months
        ];
    }
}
