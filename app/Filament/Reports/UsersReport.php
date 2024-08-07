<?php

namespace App\Filament\Reports;

use App\Models\User;
use EightyNine\Reports\Report;
use EightyNine\Reports\Components\Body;
use EightyNine\Reports\Components\Footer;
use EightyNine\Reports\Components\Header;
use EightyNine\Reports\Components\Text;
use EightyNine\Reports\Components\Image;
use EightyNine\Reports\Components\Input;

use EightyNine\Reports\Components\VerticalSpace;
use Filament\Forms\Form;

class UsersReport extends Report
{
    public ?string $heading = "Report";

    public ?string $subHeading = "A great report";

    public function header(Header $header): Header
    {
        return $header
            ->schema([
                Header\Layout\HeaderRow::make()
                    ->schema([
                        Header\Layout\HeaderColumn::make()
                            ->schema([
                                Text::make("Users Report")
                                    ->title()
                                    ->primary(),
                                Text::make("A  report")
                                    ->subtitle(),
                            ]),
                        Header\Layout\HeaderColumn::make()
                            ->schema([
                                Image::make('imagePath'),
                            ])
                            ->alignRight(),
                    ]),
            ]);
    }


    public function body(Body $body): Body
    {
        return $body
            ->schema([
                Body\Layout\BodyColumn::make()
                    ->schema([
                        Body\Table::make()
                            ->data(
                                fn(?array $filters) => User::query()->get()
                            ),
                        // VerticalSpace::make(),
                        // Body\Table::make()
                        //     ->data(
                        //         fn(?array $filters) => $this->verificationSummary($filters)
                        //     ),
                    ]),
            ]);
    }

    public function footer(Footer $footer): Footer
    {
        return $footer
            ->schema([
                Footer\Layout\FooterRow::make()
                    ->schema([
                        Footer\Layout\FooterColumn::make()
                            ->schema([
                                Text::make("All users Report")
                                    ->title()
                                    ->primary(),
                                Text::make("Filter Users")
                                    ->subtitle(),
                            ]),
                        Footer\Layout\FooterColumn::make()
                            ->schema([
                                Text::make("Generated on: " . now()->format('Y-m-d H:i:s')),
                            ])
                            ->alignRight(),
                    ]),
            ]);
    }

    public function filterForm(Form $form): Form
    {
        return $form
            ->schema([
                // Input::make('search')
                //     ->placeholder('Search')
                //     ->autofocus()
                //     ->iconLeft('heroicon-o-search'),
                // Select::make('status')
                //     ->placeholder('Status')
                //     ->options([
                //         'active' => 'Active',
                //         'inactive' => 'Inactive',
                //     ]),
            ]);
    }
}
