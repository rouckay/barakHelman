<?php

namespace App\Filament\Resources;
use App\Filament\Resources\CustomersResource\Pages;
use App\Models\Customers;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;


use Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Filter;
use App\filament\Resources\CustomersResource\RelationManagers\NumerahasRelationManager;
use Filament\Support\RawJs;
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;
class CustomersResource extends Resource
{
    protected static ?string $model = Customers::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = "د مشتریانو مدیریت";

    protected static ?string $navigationLabel = 'مشتریان لیست';

    public static ?string $label = 'مـشتریان';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?int $navigationSort = 7;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Grid::make()->schema([
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
                        TextInput::make('job')
                            ->label('وظیفه')
                            ->placeholder('وظیفه')
                            ->prefixIcon('heroicon-o-identification')
                            ->maxLength(191),
                        Select::make('province')
                            ->label('ولایت')
                            ->placeholder('ولایت انتخاب کړی.')
                            ->prefixIcon('heroicon-m-globe-alt')
                            ->helperText('دایمی اوسیدو ولایت')
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
                        TextInput::make('village')
                            ->label('کلی')
                            ->placeholder('کلی')
                            ->prefixIcon('heroicon-m-map-pin')
                            ->maxLength(191)
                    ])->columnSpan(6),
                    Grid::make()->schema([
                        TextInput::make('grand_father_name')
                            ->label('د نیکه نوم')
                            ->placeholder('د نیکه نوم')
                            ->prefixIcon('heroicon-o-user')
                            ->maxLength(191),
                        TextInput::make('mobile_number')
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
                        TextInput::make('tazkira')
                            ->label('تذکره نمبر')
                            ->placeholder('تذکره نمبر')
                            ->prefixIcon('heroicon-o-identification')
                            ->maxLength(191),
                        FileUpload::make('Customer_image')
                            ->directory('Customers_images')
                            ->preserveFilenames()
                            ->downloadable()
                            ->placeholder('تصویر مشتری')
                            ->openable()
                            ->uploadingMessage('د مشتری عکس د اپلوډ په حال کی دی...')
                            ->previewable()
                            ->required()
                            ->label('د مشتری تصویر'),
                    ])->columnSpan(6)
                ])->columns(12),
                Placeholder::make('د مشتری د وکیل معلومات'),
                Card::make()->schema([
                    Grid::make()->schema([
                        TextInput::make('responsable_name')
                            ->label('نوم')
                            // ->helperText('مکمل نوم')
                            ->required()
                            ->prefixIcon('heroicon-o-user')
                            ->placeholder('نام')
                            ->maxLength(191),
                        TextInput::make('responsable_father_name')
                            ->label('د پلار نوم')
                            ->placeholder('د پلار نوم')
                            ->prefixIcon('heroicon-o-user')
                            ->maxLength(191),
                        TextInput::make('responsable_job')
                            ->label('وظیفه')
                            ->placeholder('وظیفه')
                            ->prefixIcon('heroicon-o-identification')
                            ->maxLength(191),
                        Select::make('responsable_province')
                            ->label('ولایت')
                            ->placeholder('ولایت انتخاب کړی.')
                            ->prefixIcon('heroicon-m-globe-alt')
                            ->helperText('دایمی اوسیدو ولایت')
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
                        TextInput::make('responsable_village')
                            ->label('کلی')
                            ->placeholder('کلی')
                            ->prefixIcon('heroicon-m-map-pin')
                            ->maxLength(191)
                    ])->columnSpan(6),
                    Grid::make()->schema([
                        TextInput::make('responsable_grand_father_name')
                            ->label('د نیکه نوم')
                            ->placeholder('د نیکه نوم')
                            ->prefixIcon('heroicon-o-user')
                            ->maxLength(191),
                        TextInput::make('responsable_mobile_number')
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
                        TextInput::make('responsable_tazkira')
                            ->label('تذکره نمبر')
                            ->placeholder('تذکره نمبر')
                            ->prefixIcon('heroicon-o-identification')
                            ->maxLength(191),
                        FileUpload::make('responsable_image')
                            ->directory('responsable_image')
                            ->preserveFilenames()
                            ->downloadable()
                            ->placeholder('تصویر مشتری')
                            ->openable()
                            ->uploadingMessage('د مشتری عکس د اپلوډ په حال کی دی...')
                            ->previewable()
                            ->required()
                            ->label('د مشتری تصویر'),
                    ])->columnSpan(6)
                ])->columns(12)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('row_number')
                    ->label('نمبر')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->label('نوم')
                    ->toggleable()
                    ->searchable(),
                BadgeableColumn::make('name')
                    ->suffixBadges([
                        Badge::make('hot')
                            ->label(fn($record) => ' نمری (ځمکی): ' . $record->numerahas()->count())
                            ->color('success')
                            ->visible(fn($record) => $record->numerahas()->count() > 0),
                    ]),
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
                    ->toggleable(isToggledHiddenByDefault: true)
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
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->label('وظیفه')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('د ثبت نیټه ')
                    ->date()
                    ->sortable()
                    ->since()
                    ->dateTimeTooltip()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->date()
                    ->label('د بدلون نیټه')
                    ->sortable()
                    ->since()
                    ->dateTimeTooltip()
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
            ->actions([
                \Filament\Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->label('کتل')
                    ,
                    Tables\Actions\EditAction::make()
                        ->label('بدلون')
                    ,
                ]),
                Tables\Actions\ViewAction::make()
                    ->label('کتل')
                ,
                Tables\Actions\EditAction::make()
                    ->label('بدلون')
                ,
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
            NumerahasRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomers::route('/create'),
            'view' => Pages\ViewCustomers::route('/{record}'),
            'edit' => Pages\EditCustomers::route('/{record}/edit'),
        ];
    }
}
