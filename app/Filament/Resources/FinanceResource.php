<?php
namespace App\Filament\Resources;

use App\Filament\Resources\FinanceResource\Pages;
use App\Filament\Resources\FinanceResource\RelationManagers;
use App\Models\Finance;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Repeater;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;
use Ysfkaya\FilamentPhoneInput\Infolists\PhoneEntry;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Support\RawJs;
use Illuminate\Support\HtmlString;

class FinanceResource extends Resource
{
    protected static ?string $model = Finance::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = "مالی مدیریت";

    protected static ?int $navigationSort = 4;
    public static ?string $label = 'د لګښتونو مدیریت';

    public static function infolists(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns([
                PhoneEntry::make('phone')->displayFormat(PhoneInputNumberType::NATIONAL),
            ]);
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Repeater::make('Finance Expeses')->schema([
                Card::make([
                    Grid::make()->schema([
                        Forms\Components\TextInput::make('phone_number')
                            ->numeric()
                            ->placeholder(' 234 5678 071')
                            ->extraAttributes([
                                'oninput' => 'this.value = this.value.replace(/[٠-٩]/g, function(d) { return d.charCodeAt(0) - 1632; });'
                            ])
                            // ->helperText('07 په اتومات ډول خپله سیستم لیکی تاسی خپل باقی نمبر ټایپ کړی')
                            ->mask(RawJs::make(<<<'JS'
                                    $input.startsWith('07') ? '079-999-9999' : '079-999-9999'? :''
                            JS))
                            ->maxLength(12)
                            ->prefixIcon('heroicon-o-phone')
                            ->label('د پلورونکی تلفن نمبر'),
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('مصرف کوونکی')
                            ->helperText('چاچی مصرف کړی د هغی کس نوم دلته ذکر کیږی.')
                            ->prefixIcon('heroicon-o-user')
                            ->default(auth()->user()->id)
                            ->required(),
                        Forms\Components\DateTimePicker::make('date_purchase')
                            ->helperText('په کومه نیټه مو مصرف کړی.')
                            ->label('د پیرودلو نیټه')
                            ->prefixIcon('heroicon-o-calendar-days')
                            ->default(now()->toDateString())
                            ->required(),
                    ])->columns(3),
                    Forms\Components\RichEditor::make('description')
                        ->label('توضیحات')
                        ->placeholder('دلته خپل ټول توضیحات ولیکی د مصرف په اړه')
                        ->required()
                        ->columnSpanFull(),
                ]),
                // Repeater::make('Finance')->schema([
                Card::make()->schema([
                    Grid::make()->schema([
                        Forms\Components\TextInput::make('quantity')
                            ->required()
                            ->label('مقدار')
                            ->live()
                            ->helperText('مقدار د خرید یا هم د مصرف')
                            ->dehydrated()
                            ->prefixIcon('heroicon-o-banknotes')
                            ->default(1)
                            ->numeric(),
                        Forms\Components\TextInput::make('unit')
                            ->required()
                            ->label('قیمت فی واحد (افغانی) ')
                            ->dehydrated()
                            ->helperText('فی واحد په افغانی باندی')
                            ->prefixIcon('heroicon-o-banknotes')
                            ->default(1)
                            ->live()
                            ->numeric(),
                        Forms\Components\Placeholder::make('total_price')
                            ->label('ټولټال لګښت (افغانی)')
                            ->helperText('افغانی ')
                            ->content(function ($get) {
                                $quantity = $get('quantity');
                                $unit = $get('unit');
                                if (!is_numeric($quantity) || !is_numeric($unit)) {
                                    return new HtmlString('<p style="color:red;border:2px solid red; padding:3px;border-radius:10px"><strong>مهربانی وکړی یوازې عددي ارزښتونه اضافه کړی!</strong></p>');

                                } else if ($quantity == 0 || $unit == 0) {
                                    return new HtmlString('<p style="color:red;border:2px solid red; padding:3px;border-radius:10px"><strong>مهربانی وکړی د 1 څخه جګ عدد انتخاب کړی!</strong></p>');
                                }
                                return $quantity * $unit;
                            }),
                    ])->columns(3),
                    Grid::make()->schema([
                        Forms\Components\TextInput::make('dollor')
                            ->required()
                            ->label('مقدار')
                            ->helperText('مقدار په ډالر باندی')
                            ->live()
                            ->default(1)
                            // ->afterStateUpdated(function (string $state, $operation, callable $get, callable $set) {
                            //     if ($operation !== 'create') {
                            //         return;
                            //     }

                            //     $dollor = $get('dollor'); // Use $get to retrieve the value of 'dollor_unit'
                            //     $dollor_price = $get('dollor_price');
                            //     $dollor_unit = $get('dollor_unit');
                            //     $set('dollor_to_afghani', $dollor * $dollor_price * $dollor_unit);
                            // })
                            ->prefixIcon('heroicon-o-banknotes')
                            ->numeric(),
                        Forms\Components\TextInput::make('dollor_unit')
                            ->helperText('یو جنس قیمت په ډالر باندی')
                            ->required()
                            ->label('قیمت فی واحد (ډالر) ')
                            ->prefixIcon('heroicon-o-banknotes')
                            ->live()
                            ->dehydrated()
                            ->default(1)
                            ->numeric(),
                        Forms\Components\TextInput::make('dollor_price')
                            ->required()
                            ->label('تبادله (ډالر /افغانی) ')
                            ->prefixIcon('heroicon-o-banknotes')
                            ->live()
                            ->default(71)
                            ->extraInputAttributes(['color' => 'red'])
                            ->helperText('د ډالر قیمت')
                            ->numeric(),
                        Forms\Components\Placeholder::make('dollor_to_afghani')
                            ->label('ټولټال افغانی')
                            ->helperText('مجمعه لګښت په افغانی باندی')
                            ->content(function ($get) {
                                $dollor = $get('dollor');
                                $dollorPrice = $get('dollor_price');
                                $dollorUnit = $get('dollor_unit');

                                if (!is_numeric($dollor) || !is_numeric($dollorPrice) || !is_numeric($dollorUnit)) {
                                    return new HtmlString('<p style="color:red;border:2px solid red; padding:3px;border-radius:10px"><strong>مهربانی وکړی یوازې عددي ارزښتونه اضافه کړی!</strong></p>');

                                } else if ($dollor == 0 || $dollorPrice == 0 || $dollorUnit == 0) {
                                    return new HtmlString('<p style="color:red;border:2px solid red; padding:3px;border-radius:10px"><strong>مهربانی وکړی د 1 څخه جګ عدد انتخاب کړی!</strong></p>');
                                }

                                return $dollor * $dollorPrice * $dollorUnit;
                            })
                            ->default(71),

                        Forms\Components\Placeholder::make('dollor_total')
                            ->label('ټولټال لګښت (ډالر)')
                            ->helperText('مجمعه لګښت په ډالرو باندی')
                            ->content(function ($get) {
                                $dollor = $get('dollor');
                                $dollorUnit = $get('dollor_unit');
                                if (!is_numeric($dollor) || !is_numeric($dollorUnit)) {
                                    return new HtmlString('<p style="color:red;border:2px solid red; padding:3px;border-radius:10px"><strong>مهربانی وکړی یوازې عددي ارزښتونه اضافه کړی!</strong></p>');
                                } else if ($dollor == 0 || $dollorUnit == 0) {
                                    return new HtmlString('<p style="color:red;border:2px solid red; padding:3px;border-radius:10px"><strong>مهربانی وکړی د 1 څخه جګ عدد انتخاب کړی!</strong></p>');
                                }

                                return $dollor * $dollorUnit;
                            }),
                        // ])->columnSpanFull(),
                    ])->columns(5),
                ])
                // ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('row_number')
                    ->label('نمبر')
                    ->toggleable()
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->searchable()
                    ->label('مقدار')
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit')
                    ->numeric()
                    ->searchable()
                    ->toggleable()
                    ->label('فی واحد')
                    ->sortable(),
                Tables\Columns\TextColumn::make('dollor')
                    ->numeric()
                    ->toggleable()
                    ->searchable()
                    ->label('دالر')
                    ->sortable(),
                PhoneColumn::make('phone_number')->displayFormat(PhoneInputNumberType::NATIONAL)
                    ->numeric()
                    ->searchable()
                    ->toggleable()
                    ->label('شماره تلفن')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->searchable()
                    ->toggleable()
                    ->label('مصرف کننده')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('د ثبت نیټه')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('د بدلون نیټه')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('user_id')
                    ->relationship('user', 'name'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFinances::route('/'),
            'create' => Pages\CreateFinance::route('/create'),
            'view' => Pages\ViewFinance::route('/{record}'),
            'edit' => Pages\EditFinance::route('/{record}/edit'),
        ];
    }
}
