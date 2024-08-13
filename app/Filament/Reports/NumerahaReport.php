<?php

namespace App\Filament\Reports;

use EightyNine\Reports\Report;
use EightyNine\Reports\Components\Body;
use EightyNine\Reports\Components\Footer;
use EightyNine\Reports\Components\Header;
use EightyNine\Reports\Components\Text;
use EightyNine\Reports\Components\Image;
use EightyNine\Reports\Components\Input;
use Filament\Forms\Form;
use eightyNine\Reports\components\VerticalSpace;

class NumerahaReport extends Report
{
    public ?string $heading = "مدیریت راپورها";



    // public ?string $subHeading = "A great report";

    public function header(Header $header): Header
    {
        return $header
            ->schema([
                Header\Layout\HeaderRow::make()
                    ->schema([
                        Header\Layout\HeaderColumn::make()
                            ->schema([
                                Text::make("User registration report")
                                    ->title()
                                    ->primary(),
                                Text::make("A user registration report")
                                    ->subtitle(),
                            ]),
                        Header\Layout\HeaderColumn::make()
                            ->schema([
                                Image::make(''),
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
                // ->schema([
                //     Body\Table::make()
                //     // ->data(

                //     // )
                //     ,
                //     // VerticalSpace::make(),
                //     Body\Table::make()
                //     // ->data(
                //     //     fn(?array $filters) => $this->verificationSummary($filters)
                //     // )
                //     ,
                // ]),
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