<?php

namespace App\Filament\Reports;

use EightyNine\Reports\Report;
use EightyNine\Reports\Components\Body;
use EightyNine\Reports\Components\Footer;
use EightyNine\Reports\Components\Header;
use EightyNine\Reports\Components\Text; // This is likely the correct import
use EightyNine\Reports\Components\Input; // This is likely the correct import
use EightyNine\Reports\Components\Image; // Ensure Image is also correctly imported
use EightyNine\Reports\Components\VerticalSpace; // Ensure Image is also correctly imported
use Filament\Forms\Form;
use Filament\Tables\Columns\Column;
use App\Models\CustomerNumeraha;
class NumerahaIncome extends Report
{
    public ?string $heading = "Report";

    // public ?string $subHeading = "A great report";
    public function registrationSummary(?array $filters)
    {
        // Fetch the data based on filters or return all data
        $query = CustomerNumeraha::query();

        if ($filters) {
            // Apply any filters to the query
            if (isset($filters['date_from'])) {
                $query->where('created_at', '>=', $filters['date_from']);
            }

            if (isset($filters['date_to'])) {
                $query->where('created_at', '<=', $filters['date_to']);
            }

            // Add any other filters as needed
        }

        return $query->get();
    }

    public function verificationSummary(?array $filters)
    {
        // Similar logic for verification summary, adjusting the query as needed
        $query = CustomerNumeraha::query();

        if ($filters) {
            // Apply filters for verification summary
            // For example, filter by verification status
            if (isset($filters['verified'])) {
                $query->where('is_verified', $filters['verified']);
            }
        }

        return $query->get();
    }
    public function header(Header $header): Header
    {
        return $header
            ->schema([
                Header\Layout\HeaderRow::make()
                    ->schema([
                        Header\Layout\HeaderColumn::make()
                            ->schema([
                                Text::make("د نمرو د عوایدو برخه")
                                    ->title()
                                    ->primary(),
                                Text::make("تاسی ټول عواید د نمرو نه په لاندی ډول دی.")
                                    ->subtitle(),
                            ]),
                        Header\Layout\HeaderColumn::make()
                            ->schema([
                                // Image::make(),
                            ])
                            ->alignRight(),
                    ]),
            ]);
    }
    public function body(Body $body): Body
    {
        return $body
            ->schema([
                Body\Table::make()
                    ->data(
                        fn(?array $filters) => $this->registrationSummary($filters)
                    )
                    ->columns([
                        Column::make('customer.name')
                            ->label('Customer Name'),

                        Column::make('numeraha.numera_id')
                            ->label('Numeraha ID'),

                        // Add other columns as needed
                    ]),
                VerticalSpace::make(),
                Body\Table::make()
                    ->data(
                        fn(?array $filters) => $this->verificationSummary($filters)
                    )
                    ->columns([
                        Column::make('customer.name')
                            ->label('Customer Name'),

                        Column::make('is_verified')
                            ->label('Verification Status'),

                        // Add other columns as needed
                    ]),
            ]);
    }

    public function footer(Footer $footer): Footer
    {
        return $footer
            ->schema([
                // ...
            ]);
    }

    public function filterForm(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }
}
