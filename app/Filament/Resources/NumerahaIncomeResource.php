<?php

namespace App\Filament\Resources;
use NumberFormatter;

use App\Filament\Resources\NumerahaIncomeResource\Pages;
use App\Filament\Resources\NumerahaIncomeResource\RelationManagers;
use App\Models\CustomerNumeraha;
use App\Models\NumerahaIncome;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use Filament\Tables\Columns\Summarizers\Average;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\Summarizers\Count;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Carbon\Carbon;

// price to number show
function numberToWordsInPashto($number)
{
    $words = [
        0 => 'صفر',
        1 => 'یو',
        2 => 'دوه',
        3 => 'درې',
        4 => 'څلور',
        5 => 'پنځه',
        6 => 'شپږ',
        7 => 'اووه',
        8 => 'اته',
        9 => 'نهه',
        10 => 'لس',
        20 => 'شل',
        30 => 'دېرش',
        40 => 'څلوېښت',
        50 => 'پنځوس',
        60 => 'شپېته',
        70 => 'اویا',
        80 => 'اتهام',
        90 => 'نوي',
        100 => 'سل',
        1000 => 'زره',
    ];

    if ($number < 11) {
        return $words[$number];
    }

    if ($number < 100) {
        $tens = floor($number / 10) * 10;
        $unit = $number % 10;
        return $unit === 0 ? $words[$tens] : $words[$tens] . ' او ' . $words[$unit];
    }

    if ($number < 1000) {
        $hundreds = floor($number / 100);
        $remainder = $number % 100;
        return $remainder === 0 ? $words[$hundreds] . ' سل' : $words[$hundreds] . ' سل او ' . numberToWordsInPashto($remainder);
    }

    if ($number >= 1000) {
        $thousands = floor($number / 1000);
        $remainder = $number % 1000;
        return $remainder === 0 ? $words[$thousands] . ' زره' : $words[$thousands] . ' زره او ' . numberToWordsInPashto($remainder);
    }

    return '';
}

class NumerahaIncomeResource extends Resource
{
    protected static ?string $model = CustomerNumeraha::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'د عوایدو مدیریت';
    protected static ?string $navigationGroup = "مالی مدیریت";


    protected static ?string $title = 'د نمری ټولټال عواید';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('row_number')
                    ->label('نمبر')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('numeraha.numera_id')
                    ->label('د نمری آی ډی')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('numeraha.description')
                    ->label('تفصیل')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->html(),
                Tables\Columns\TextColumn::make('numeraha.numera_type')
                    ->label('مساحت (متر مربع)')
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->html(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('د مشتری نوم')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer.mobile_number')
                    ->label('د اړیکی شمیره')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_price')
                    ->label('د نمری اصلی قیمت')
                    ->numeric()
                    ->money('AFN', locale: 'en')
                    ->sortable()
                    ->searchable()
                    ->summarize([
                        Sum::make()->label('ټولټال پیسی'),
                        Count::make()->label('ټولی پلورل شوی'),
                    ]),
                Tables\Columns\TextColumn::make('payed_price')
                    ->label('تحویل شوی پیسی')
                    ->numeric()
                    ->sortable()
                    ->money('AFN', locale: 'en')
                    ->searchable(),
                // TextColumn::make('price_in_words')
                //     ->label('تحویل شوی پیسی په حروفو')
                //     ->suffix(' - افغانی')
                //     ->getStateUsing(function ($record) {
                //         return numberToWordsInPashto($record->payed_price);
                //     })->badge()
                //     ->color('success'),
                Tables\Columns\TextColumn::make('due_price')
                    ->getStateUsing(fn($record) => $record->total_price - $record->payed_price)
                    ->badge()
                    ->money('AFN', locale: 'en')
                    ->label('باقی پیسی')
                    ->color('danger')
                ,
                TextColumn::make('created_at')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('د ثبت تاریخ')
                    ->since()
                    ->dateTimeTooltip()
                ,
                TextColumn::make('updated_at')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('د ثبت تاریخ')
                    ->since()
                    ->dateTimeTooltip()
                ,
            ])
            ->filters([
                Filter::make('today')
                    ->label('ورځنی')
                    ->query(
                        fn(Builder $query): Builder => $query
                            ->whereDate('created_at', Carbon::today())
                    ),
                Filter::make('this_week')
                    ->query(
                        fn(Builder $query): Builder => $query
                            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    )
                    ->label('هفته وار'),
                Filter::make('this_month')
                    ->query(
                        fn(Builder $query): Builder => $query
                            ->whereBetween('created_at', [
                                Carbon::now()->startOfMonth()->startOfDay(),
                                Carbon::now()->endOfMonth()->endOfDay()
                            ])
                    )
                    ->label('میاشتنی'),
                Filter::make('this_year')
                    ->query(
                        fn(Builder $query): Builder => $query
                            ->whereBetween('created_at', [
                                Carbon::now()->startOfYear()->startOfDay(),
                                Carbon::now()->endOfYear()->endOfDay()
                            ])
                    )
                    ->label('کلنی'),
                Filter::make('period')
                    ->query(
                        fn(Builder $query): Builder => $query
                            ->whereBetween('created_at', [
                                $query->min('created_at') ?? Carbon::minValue(), // Start from the earliest record or default min date
                                Carbon::now()->endOfDay()
                            ])
                    )
                    ->label('ټولټال عواید')
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNumerahaIncomes::route('/'),
            'create' => Pages\CreateNumerahaIncome::route('/create'),
            'edit' => Pages\EditNumerahaIncome::route('/{record}/edit'),
        ];
    }
}
