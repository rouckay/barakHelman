<?php

namespace App\Filament\Resources\NumerahaResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\HtmlString;
use App\Models\Customers;

class CustomersRelationManager extends RelationManager
{
    protected static string $relationship = 'Customers';
    protected static ?string $navigationLabel = 'ددی ځمکی مشتریان';
    protected static ?string $title = 'د پورتنی نمری (ځمکی) ټول مشتریان';

    protected function getParentNumerahaData(): array
    {
        $numeraha = $this->ownerRecord; // Access the parent Numeraha model

        return [
            'numera_price' => $numeraha->numera_price,
            'numero_number' => $numeraha->numero_number,
            // Add other fields as needed
        ];
    }
    public function form(Form $form): Form
    {
        $numerahaData = $this->getParentNumerahaData();
        // return $form
        //     ->schema([
        //         Forms\Components\Select::make('customer_id')
        //             ->label('Customer')
        //             ->relationship('Customers', 'name') // Use 'numeraha' if 'numeraha' is the correct relationship name
        //             ->searchable()
        //             ->required(),
        //         // Other fields...
        //     ]);
        return $form
            ->schema([
                Forms\Components\Tabs::make('New_customer')->
                    tabs([
                        Tab::make('مشتری جدید')->schema([
                            Card::make()->schema([
                                Grid::make()->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->label('نوم')
                                        ->prefixIcon('heroicon-o-user')
                                        ->required()
                                        ->maxLength(191),
                                    Forms\Components\TextInput::make('father_name')
                                        ->label('د پلار نوم')
                                        ->prefixIcon('heroicon-o-user')
                                        ->maxLength(191),
                                    Forms\Components\TextInput::make('grand_father_name')
                                        ->label('د نیکه نوم')
                                        ->prefixIcon('heroicon-o-user')
                                        ->maxLength(191),
                                    Forms\Components\Select::make('province')
                                        ->label('ولایت')
                                        ->prefixIcon('heroicon-m-globe-alt')
                                        ->placeholder('ولایت انتخاب کړی.')
                                        ->options([
                                            'بلخ' => 'بلخ',
                                            'بامیان' => 'بامیان',
                                            'بادغیس' => 'بادغیس',
                                            'بدخشان' => 'بدخشان',
                                            'بغلان' => 'بغلان',
                                            'دایکندی' => 'دایکندی',
                                            'فراه' => 'فراه',
                                            'فاریاب' => 'فاریاب',
                                            'غزنی' => 'غزنی',
                                            'غور' => 'غور',
                                            'هلمند' => 'هلمند',
                                            'هرات' => 'هرات',
                                            'جوزجان' => 'جوزجان',
                                            'کابل' => 'کابل',
                                            'قندهار' => 'قندهار',
                                            'کاپیسا' => 'کاپیسا',
                                            'کندز' => 'کندز',
                                            'خوست' => 'خوست',
                                            'کنر' => 'کنر',
                                            'لغمان' => 'لغمان',
                                            'لوگر' => 'لوگر',
                                            'ننگرهار' => 'ننگرهار',
                                            'نیمروز' => 'نیمروز',
                                            'نورستان' => 'نورستان',
                                            'پنجشیر' => 'پنجشیر',
                                            'پروان' => 'پروان',
                                        ]),
                                    Forms\Components\TextInput::make('village')
                                        ->label('کلی')
                                        ->prefixIcon('heroicon-m-map-pin')
                                        ->maxLength(191),
                                    Forms\Components\TextInput::make('tazkira')
                                        ->label('تذکره نمبر')
                                        ->prefixIcon('heroicon-o-identification')
                                        ->maxLength(191),
                                    Forms\Components\TextInput::make('parmanent_address')
                                        ->label('دایمی داوسیدو پته ')
                                        ->prefixIcon('heroicon-o-map-pin')
                                        ->maxLength(191),
                                ])->columnSpan(6),
                                Grid::make()->schema([
                                    Forms\Components\TextInput::make('current_address')
                                        ->label('اوسنی داوسیدو پته ')
                                        ->prefixIcon('heroicon-o-map-pin')
                                        ->maxLength(191),
                                    Forms\Components\TextInput::make('total_price')
                                        ->live()
                                        ->prefixIcon('heroicon-o-banknotes')
                                        ->default($numerahaData['numera_price'])
                                        ->disabled()
                                        ->label('د نمری (ځمکی) قیمت')
                                        ->dehydrated()
                                        ->numeric()
                                    ,
                                    Forms\Components\TextInput::make('payed_price')
                                        ->label('تحویل شوی پیسی')
                                        ->live()
                                        ->dehydrated()
                                        ->numeric()
                                        ->prefixIcon('heroicon-o-banknotes')
                                    ,
                                    Forms\Components\Placeholder::make('due_price')
                                        ->label('باقی پیسی')
                                        ->content(function ($get) {
                                            $total_price = $get('total_price');
                                            $payed_price = $get('payed_price');
                                            if ($payed_price <= 0) {
                                                return new HtmlString('<p style="color:red;border:2px solid red; padding:3px;border-radius:10px"><strong>تحویل شوی پیسی اندازه غلطه ده!</strong></p>');
                                            }
                                            $duePrice = $total_price - $payed_price;
                                            return $duePrice;
                                        })
                                    ,
                                    Forms\Components\TextInput::make('mobile_number')
                                        ->label('تلفن نمبر')
                                        ->prefixIcon('heroicon-o-phone')
                                        ->maxLength(191),

                                    Forms\Components\TextInput::make('job')
                                        ->label('وظیفه')
                                        ->prefixIcon('heroicon-o-briefcase')
                                        ->maxLength(191),
                                    // Forms\Components\Select::make('numeraha_id')
                                    //     ->label('د نمری (ځمکی) آی ډی')
                                    //     ->relationship('numeraha', 'numero_number')
                                    //     ->prefixIcon('heroicon-o-map')
                                    // ,
                                ])->columnSpan(6)
                            ])->columns(12)
                        ]),
                        Tab::make('موجوده مشتری')->schema([
                            // Forms\Components\Select::make('customer')
                            //     ->query(function () {
                            //         Customers::query()->get();
                            //     }),
                            // Forms\Components\Select::make('numeraha_id')
                            //     ->label('نمره ځمکه')
                            //     ->relationship('numeraha', 'numero_number')
                            //     ->prefixIcon('heroicon-o-map'),
                        ])
                    ])->columnSpanFull()
            ]);
    }
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('مشتریان')
            // ->label('')
            ->columns([
                Tables\Columns\TextColumn::make('row_number')
                    ->label('نمبر')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->label('نوم')
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('father_name')
                    ->sortable()
                    ->label('د پلار نوم')
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('grand_father_name')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('د نیکه نوم')
                    ->searchable(),
                Tables\Columns\TextColumn::make('province')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('ولایت')
                    ->searchable(),
                Tables\Columns\TextColumn::make('village')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('کلی')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tazkira')
                    ->sortable()
                    ->toggleable()
                    ->label('تذکره نمبر')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mobile_number')
                    ->sortable()
                    ->toggleable()
                    ->label('تلفن نمبر')
                    ->searchable(),
                Tables\Columns\TextColumn::make('parmanent_address')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('دایمی داوسیدو پته ')
                    ->searchable(),
                Tables\Columns\TextColumn::make('current_address')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('اوسنی داوسیدو پته ')
                    ->searchable(),
                Tables\Columns\TextColumn::make('job')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('وظیفه')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('د ثبت نیټه ')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->date()
                    ->label('د بدلون نیټه')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                Filter::make('due_price_range')
                    ->label('قرزداران')
                    ->form([
                        Forms\Components\TextInput::make('min_due_price')
                            ->label('کمترین قرز')
                            ->numeric(),

                        Forms\Components\TextInput::make('max_due_price')
                            ->label('جګ ترین قرز')
                            ->numeric(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        // Ensure min and max values are set
                        $min = $data['min_due_price'] ?? null;
                        $max = $data['max_due_price'] ?? null;

                        // Filter logic
                        return $query->when($min !== null, fn($query) => $query->whereRaw('total_price - payed_price >= ?', [$min]))
                            ->when($max !== null, fn($query) => $query->whereRaw('total_price - payed_price <= ?', [$max]));
                    })
                    ->indicateUsing(function (array $data): array {
                        // Display current filter range
                        $indicators = [];

                        if ($data['min_due_price'] ?? null) {
                            $indicators['min_due_price'] = 'Min Due Price: $' . $data['min_due_price'];
                        }

                        if ($data['max_due_price'] ?? null) {
                            $indicators['max_due_price'] = 'Max Due Price: $' . $data['max_due_price'];
                        }

                        return $indicators;
                    }),
                Filter::make('ټول قرزداران')
                    ->query(fn(Builder $query) => $query->whereColumn('total_price', '>', 'payed_price')),
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
