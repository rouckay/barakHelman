<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerNumerahaResource\Pages;
use App\Filament\Resources\CustomerNumerahaResource\RelationManagers;
use App\Filament\Resources\CustomerNumerahaResource\RelationManagers\CustomersRelationManager;
use App\Models\CustomerNumeraha;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Support\RawJs;
use App\Models\Customers;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Placeholder;
class CustomerNumerahaResource extends Resource
{
    protected static ?string $model = CustomerNumeraha::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrow-path-rounded-square';

    // protected static ?string $navigationGroup = "د نمرو (ځمکو) مدیریت";

    protected static ?string $navigationLabel = 'د نمرو د پلورلو برخه';
    protected static ?int $navigationSort = 4;
    protected static ?string $recordTitleAttribute = 'customer_id';
    public static ?string $label = 'نمری (ځمکی) پلورل';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Card::make()->schema([
                    Grid::make()->schema([
                        Forms\Components\Select::make('customer_id')
                            ->label('مشتری')
                            ->relationship('customer', 'name') // 'customer' is the relationship method in CustomerNumeraha model
                            ->searchable()
                            ->placeholder('خپل مشتری انتخاب کړی')
                            ->getSearchResultsUsing(function (string $search) {
                                // If IDs are integers, cast the search to an integer
                                $searchById = (int) $search;

                                // Check for both ID and name
                                return Customers::query()
                                    ->where('id', $searchById) // Exact match for ID
                                    ->orWhere('name', 'like', '%' . $search . '%') // Partial match for name
                                    ->limit(50)
                                    ->pluck('name', 'id'); // Fetch names and IDs
                            })
                            ->getOptionLabelUsing(fn($value) => Customers::find($value)?->name)
                            ->required()
                            ->dehydrated()
                            ->createOptionForm([
                                Forms\Components\Card::make()->schema([
                                    Forms\Components\Grid::make()->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->label('نوم')
                                            // ->helperText('مکمل نوم')
                                            ->required()
                                            ->prefixIcon('heroicon-o-user')
                                            ->placeholder('نام')
                                            ->maxLength(191),
                                        Forms\Components\TextInput::make('father_name')
                                            ->label('د پلار نوم')
                                            ->placeholder('د پلار نوم')
                                            ->prefixIcon('heroicon-o-user')
                                            ->maxLength(191),
                                        Forms\Components\Select::make('province')
                                            ->label('ولایت')
                                            ->placeholder('ولایت انتخاب کړی.')
                                            ->prefixIcon('heroicon-m-globe-alt')
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
                                        Forms\Components\TextInput::make('district')
                                            ->label('ولسوالی')
                                            ->placeholder('ولسوالی')
                                            ->prefixIcon('heroicon-o-identification')
                                            ->maxLength(191),
                                        Forms\Components\FileUpload::make('Customer_image')
                                            ->directory('Customers_images')
                                            ->preserveFilenames()
                                            ->downloadable()
                                            ->placeholder('د مشتری انځور')
                                            ->openable()
                                            ->uploadingMessage('د مشتری عکس د اپلوډ په حال کی دی...')
                                            ->previewable()
                                            ->required()
                                            ->label('د مشتری انځور'),
                                    ])->columnSpan(6),
                                    Forms\Components\Grid::make()->schema([
                                        Forms\Components\TextInput::make('grand_father_name')
                                            ->label('د نیکه نوم')
                                            ->placeholder('د نیکه نوم')
                                            ->prefixIcon('heroicon-o-user')
                                            ->maxLength(191),
                                        Forms\Components\TextInput::make('mobile_number')
                                            ->label('تلفن نمبر')
                                            ->prefixIcon('heroicon-o-phone')
                                            ->numeric()
                                            ->placeholder(' 234 5678 071')
                                            ->extraAttributes([
                                                'oninput' => 'this.value = this.value.replace(/[٠-٩]/g, function(d) { return d.charCodeAt(0) - 1632; });'
                                            ])
                                            // ->helperText('07 په اتومات ډول خپله سیستم لیکی تاسی خپل باقی نمبر ټایپ کړی')
                                            ->mask(RawJs::make(<<<'JS'
                                                    $input.startsWith('07') ? '079-999-9999' : '079-999-9999'? :''
                                            JS))
                                            ->maxLength(12),
                                        Forms\Components\TextInput::make('village')
                                            ->label('کلی')
                                            ->placeholder('کلی')
                                            ->prefixIcon('heroicon-m-map-pin')
                                            ->maxLength(191),
                                        Forms\Components\TextInput::make('tazkira')
                                            ->label('تذکره نمبر')
                                            ->placeholder('تذکره نمبر')
                                            ->prefixIcon('heroicon-o-identification')
                                            ->maxLength(191),
                                    ])->columnSpan(6)
                                ])->columns(12),
                                Forms\Components\Placeholder::make('')
                                    ->content(new HtmlString('<strong>د مشتری د وکیل معلومات</strong>')),
                                Forms\Components\Card::make()->schema([
                                    Forms\Components\Grid::make()->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->label('نوم')
                                            // ->helperText('مکمل نوم')
                                            ->required()
                                            ->prefixIcon('heroicon-o-user')
                                            ->placeholder('نام')
                                            ->maxLength(191),
                                        Forms\Components\TextInput::make('father_name')
                                            ->label('د پلار نوم')
                                            ->placeholder('د پلار نوم')
                                            ->prefixIcon('heroicon-o-user')
                                            ->maxLength(191),
                                        Forms\Components\Select::make('province')
                                            ->label('ولایت')
                                            ->placeholder('ولایت انتخاب کړی.')
                                            ->prefixIcon('heroicon-m-globe-alt')
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
                                        Forms\Components\TextInput::make('district')
                                            ->label('ولسوالی')
                                            ->placeholder('ولسوالی')
                                            ->prefixIcon('heroicon-o-identification')
                                            ->maxLength(191),
                                        Forms\Components\FileUpload::make('Customer_image')
                                            ->directory('Customers_images')
                                            ->preserveFilenames()
                                            ->downloadable()
                                            ->placeholder('د مشتری د وکیل انځور')
                                            ->openable()
                                            ->uploadingMessage('د مشتری عکس د اپلوډ په حال کی دی...')
                                            ->previewable()
                                            ->required()
                                            ->label('د مشتری د وکیل انځور'),
                                    ])->columnSpan(6),
                                    Forms\Components\Grid::make()->schema([
                                        Forms\Components\TextInput::make('grand_father_name')
                                            ->label('د نیکه نوم')
                                            ->placeholder('د نیکه نوم')
                                            ->prefixIcon('heroicon-o-user')
                                            ->maxLength(191),
                                        Forms\Components\TextInput::make('mobile_number')
                                            ->label('تلفن نمبر')
                                            ->prefixIcon('heroicon-o-phone')
                                            ->numeric()
                                            ->placeholder(' 234 5678 071')
                                            ->extraAttributes([
                                                'oninput' => 'this.value = this.value.replace(/[٠-٩]/g, function(d) { return d.charCodeAt(0) - 1632; });'
                                            ])
                                            // ->helperText('07 په اتومات ډول خپله سیستم لیکی تاسی خپل باقی نمبر ټایپ کړی')
                                            ->mask(RawJs::make(<<<'JS'
                                                        $input.startsWith('07') ? '079-999-9999' : '079-999-9999'? :''
                                                JS))
                                            ->maxLength(12),
                                        Forms\Components\TextInput::make('village')
                                            ->label('کلی')
                                            ->placeholder('کلی')
                                            ->prefixIcon('heroicon-m-map-pin')
                                            ->maxLength(191),
                                        Forms\Components\TextInput::make('tazkira')
                                            ->label('تذکره نمبر')
                                            ->placeholder('تذکره نمبر')
                                            ->prefixIcon('heroicon-o-identification')
                                            ->maxLength(191),
                                    ])->columnSpan(6)
                                ])->columns(12),
                            ]),
                        Forms\Components\Select::make('numeraha_id')
                            ->label('نمره (ځمکه)')
                            ->relationship('numeraha', 'numera_id') // 'numeraha' is the relationship method in CustomerNumeraha model
                            ->searchable()
                            ->placeholder('د مشتری د پاره ځمکه انتخاب کړی')
                            ->preload()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (callable $set, $state) {
                                if ($state) {
                                    // Fetch customer IDs and names based on selected numeraha_id
                                    $customers = Customers::whereHas('numerahas', function ($query) use ($state) {
                                        $query->where('numeraha_id', $state);
                                    })->get();

                                    // Format the customer information as an array of arrays
                                    $customerInfo = $customers->map(function ($customer) {
                                        return [
                                            'id' => $customer->id,
                                            'name' => $customer->name,
                                            'tazkira' => $customer->tazkira,
                                        ];
                                    })->toArray();

                                    // Update the state of the customer_list field
                                    $set('customer_list', $customerInfo);
                                } else {
                                    // Clear the list if no numeraha_id is selected
                                    $set('customer_list', []);
                                }
                            }),


                    ])->columns(2),
                    Placeholder::make('customer_names')
                        ->label('ددی ځمکی مشتریان')
                        ->content(function ($get) {
                            $customers = $get('customer_list');

                            if (empty($customers)) {
                                return new HtmlString('<p>هیڅ مشتری پیدا نشوو</p>');
                            }

                            // Generate HTML table
                            $table = '<table class="w-full border border-r border-gray-300">';
                            $table .= '<thead><tr>';
                            $table .= '<th class="px-4 py-2 border-b">Customer ID</th>';
                            $table .= '<th class="px-4 py-2 border-b">Tazkira</th>';
                            $table .= '<th class="px-4 py-2 border-b">Customer Name</th>';
                            $table .= '</tr></thead><tbody>';

                            foreach ($customers as $customer) {
                                $table .= '<tr>';
                                $table .= '<td class="px-4 py-2 border-b">' . $customer['id'] . '</td>';
                                $table .= '<td class="px-4 py-2 border-b">' . $customer['tazkira'] . '</td>';
                                $table .= '<td class="px-4 py-2 border-b">' . $customer['name'] . '</td>';
                                $table .= '</tr>';
                            }

                            $table .= '</tbody></table>';
                            return new HtmlString($table); // Use HtmlString to render the content as HTML
                        }),
                    Forms\Components\RichEditor::make('remarks')
                        ->label('اضافه معلومات')
                        ->placeholder('د ځمکی په باره که اضافه معلومات مو دلته اضافه کړی')
                        ->maxLength(191),
                ])->columnSpan(8),
                Card::make()->schema([
                    Forms\Components\FileUpload::make('multipleDocs')
                        ->directory('customer_numeraha')
                        ->preserveFilenames()
                        ->downloadable()
                        ->multiple()
                        ->placeholder('ټول آسناد')
                        ->openable()
                        ->uploadingMessage('فایل شما در حال اپلود به دیتابیس هست...')
                        ->previewable()
                        ->maxFiles(5)
                        ->acceptedFileTypes(['application/pdf', 'image/*'])
                        ->label('د ځمکی اسناد'),
                ])->columnSpan(4),
                Card::make()->schema([
                    Forms\Components\Grid::make()->schema([
                        Forms\Components\TextInput::make('first_phase')
                            ->label('لمړی قست')
                            ->numeric()
                            ->live(onBlur: true)
                            ->prefixIcon('heroicon-o-banknotes')
                            ->placeholder('لمړی قست')
                            ->maxLength(191)
                            ->afterStateUpdated(function ($state, $set, $get) {
                                self::updatePayedPrice($state, $get, $set, 'first_phase');
                            }),

                        TextInput::make('payed_price_initial')
                            ->hidden()
                            ->default(0),
                        Forms\Components\TextInput::make('second_phase')
                            ->label('دوهم قست')
                            ->numeric()
                            ->live(onBlur: true)
                            ->prefixIcon('heroicon-o-banknotes')
                            ->placeholder('دوهم قست')
                            ->maxLength(191)
                            ->afterStateUpdated(function ($state, $set, $get) {
                                self::updatePayedPrice($state, $get, $set, 'second_phase');
                            }),

                        TextInput::make('payed_price_initial')
                            ->hidden()
                            ->default(0),
                        Forms\Components\TextInput::make('third_phase')
                            ->label('دریم قست')
                            ->numeric()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, $set, $get) {
                                self::updatePayedPrice($state, $get, $set, 'third_phase');
                            })
                            ->prefixIcon('heroicon-o-banknotes')
                            ->placeholder('دریم قست')
                            ->maxLength(191),
                    ])->columns(3),

                    Forms\Components\Grid::make()->schema([
                        Forms\Components\TextInput::make('fourth_phase')
                            ->label('څلورم قست')
                            ->numeric()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, $set, $get) {
                                self::updatePayedPrice($state, $get, $set, 'fourth_phase');
                            })
                            ->prefixIcon('heroicon-o-banknotes')
                            ->placeholder('څلورم قست')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('fifth_phase')
                            ->label('پنځم قست')
                            ->numeric()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, $set, $get) {
                                self::updatePayedPrice($state, $get, $set, 'fifth_phase');
                            })
                            ->prefixIcon('heroicon-o-banknotes')
                            ->placeholder('پنځم قست')
                            ->maxLength(191),
                    ])->columns(2),
                    Forms\Components\Grid::make()->schema([
                        Forms\Components\TextInput::make('payed_price')
                            ->label('رسید پیسی')
                            ->numeric()
                            ->live()
                            ->prefixIcon('heroicon-o-banknotes'),
                        Forms\Components\TextInput::make('total_price')
                            ->label('محمعه پیسی')
                            ->numeric()
                            ->live()
                            ->dehydrated()
                            ->prefixIcon('heroicon-o-banknotes'),
                        Forms\Components\Placeholder::make('due_price')
                            ->label('باقی پیسی')
                            ->content(function ($get) {
                                $payed_price = $get('payed_price') ?? 0;
                                $total_price = $get('total_price') ?? 0;

                                if (!is_numeric($payed_price) || !is_numeric($total_price)) {
                                    return new HtmlString('<p style="color:red;border:2px solid red; padding:3px;border-radius:10px"><strong>مهربانی وکړی یوازې عددي ارزښتونه اضافه کړی!</strong></p>');
                                }

                                if ($payed_price <= 0 || $total_price <= 0) {
                                    return new HtmlString('<p style="color:red;border:2px solid red; padding:3px;border-radius:10px"><strong>مهربانی وکړی د 1 څخه جګ عدد انتخاب کړی!</strong></p>');
                                }

                                return $total_price - $payed_price;
                            }),
                        TextInput::make('first_phase_hidden')->hidden()->default(0),
                        TextInput::make('second_phase_hidden')->hidden()->default(0),
                        TextInput::make('third_phase_hidden')->hidden()->default(0),
                        TextInput::make('fourth_phase_hidden')->hidden()->default(0),
                        TextInput::make('fifth_phase_hidden')->hidden()->default(0),
                    ])->columns(3),
                ]),
            ])->columns(12);
    }
    private static function updatePayedPrice($state, $get, $set, $phase)
    {
        $newValue = is_numeric($state) ? (float) $state : 0;

        // Update the hidden value for the current phase
        $set("{$phase}_hidden", $newValue);

        // Recalculate the payed_price
        $firstPhase = $get('first_phase_hidden') ?? 0;
        $secondPhase = $get('second_phase_hidden') ?? 0;
        $thirdPhase = $get('third_phase_hidden') ?? 0;
        $fourthPhase = $get('fourth_phase_hidden') ?? 0;
        $fifthPhase = $get('fifth_phase_hidden') ?? 0;

        $payedPrice = $firstPhase + $secondPhase + $thirdPhase + $fourthPhase + $fifthPhase;

        // Set the updated payed_price
        $set('payed_price', $payedPrice);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('row_number')
                    ->label('نمبر')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->numeric()
                    ->label('نوم د مشتری')
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('numeraha_id')
                    ->numeric()
                    ->toggleable()
                    ->label('د نمری (ځمکی) آی ډی')
                    ->sortable(),
                Tables\Columns\TextColumn::make('multipleDocs')
                    ->searchable()
                    ->label('د نمری (ځمکی) اسناد')
                    ->toggleable()
                ,
                Tables\Columns\TextColumn::make('remarks')
                    ->toggleable()
                    ->label('اضافه معلومات')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('د ثبت نیټه ')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('د بدلون نیټه')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('کتل'),
                Tables\Actions\EditAction::make()
                    ->label('بدلون'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomerNumerahas::route('/'),
            'create' => Pages\CreateCustomerNumeraha::route('/create'),
            'view' => Pages\ViewCustomerNumeraha::route('/{record}'),
            'edit' => Pages\EditCustomerNumeraha::route('/{record}/edit'),
        ];
    }
}
