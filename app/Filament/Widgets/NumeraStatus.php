<?php

namespace App\Filament\Widgets;

use App\Models\Numeraha;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class NumeraStatus extends ChartWidget
{
    protected static ?string $heading = 'د نمری (ځمکی) پلورل';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $now = Carbon::now();

        // Initialize arrays to store counts
        $withCustomerCounts = [];
        $withoutCustomerCounts = [];
        $months = [];

        // Loop through each month
        foreach (range(1, 12) as $month) {
            $startOfMonth = $now->copy()->month($month)->startOfMonth();
            $endOfMonth = $now->copy()->month($month)->endOfMonth();

            // Count numerahas with and without customers
            $withCustomerCounts[] = Numeraha::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->whereHas('customers') // Numerahas that have at least one customer
                ->count();

            $withoutCustomerCounts[] = Numeraha::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->whereDoesntHave('customers') // Numerahas that have no customers
                ->count();

            // Store the month name
            $months[] = $startOfMonth->format('M');
        }

        // Return data for the chart
        return [
            'datasets' => [
                [
                    'label' => 'پلورل شوی نمری',
                    'data' => $withCustomerCounts,
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                ],
                [
                    'label' => 'پاتی نمری',
                    'data' => $withoutCustomerCounts,
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
