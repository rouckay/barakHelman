<?php

namespace App\Filament\Resources\NumerahaResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomersRelationManager extends RelationManager
{
    protected static string $relationship = 'Customers';
    protected static ?string $navigationLabel = 'ددی ځمکی مشتریان';

    public function form(Form $form): Form
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
                        Forms\Components\Select::make('numeraha_id')
                            ->label('نمره ځمکه')
                            ->relationship('numerahas', 'numero_number')

                        ,
                        Forms\Components\TextInput::make('payed_price')
                            ->label('رسید پیسی')
                            ->live()
                            ->dehydrated()
                        ,
                        Forms\Components\TextInput::make('total_price')
                            ->live()
                            ->label('محمعه پیسی')
                        ,
                        Forms\Components\Placeholder::make('due_price')
                            ->label('باقی پیسی')
                            ->content(function ($get) {
                                $duePrice = $get('payed_price') - $get('total_price');
                                return $duePrice;
                            })
                        ,
                    ])->columnSpan(6)
                ])->columns(12)
            ]);
    }
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
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
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
