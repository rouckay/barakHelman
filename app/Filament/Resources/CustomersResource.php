<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomersResource\Pages;
use App\Models\Customers;
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

class CustomersResource extends Resource
{
    protected static ?string $model = Customers::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'مشتریان';

    protected static ?string $recordTitleAttribute = 'name';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Grid::make()->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('نوم')
                            ->required()
                            ->maxLength(191),
                        Forms\Components\TextInput::make('father_name')
                            ->label('د پلار نوم')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('grand_father_name')
                            ->label('د نیکه نوم')
                            ->maxLength(191),
                        Forms\Components\Select::make('province')
                            ->label('ولایت')
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
                            ->maxLength(191),
                        Forms\Components\TextInput::make('tazkira')
                            ->label('تذکره نمبر')
                            ->maxLength(191),
                    ])->columnSpan(6),
                    Grid::make()->schema([
                        Forms\Components\TextInput::make('mobile_number')
                            ->label('تلفن نمبر')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('parmanent_address')
                            ->label('دایمی داوسیدو پته ')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('current_address')
                            ->label('اوسنی داوسیدو پته ')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('job')
                            ->label('وظیفه')
                            ->maxLength(191),
                    ])->columnSpan(6)
                ])->columns(12)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
                    ->toggleable()
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
                    ->toggleable()
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
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->date()
                    ->label('د بدلون نیټه')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([

            ])
            ->actions([
                \Filament\Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                ]),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomers::route('/create'),
            'view' => Pages\ViewCustomers::route('/{record}'),
            'edit' => Pages\EditCustomers::route('/{record}/edit'),
        ];
    }
}
