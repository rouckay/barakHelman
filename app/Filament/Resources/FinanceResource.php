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

class FinanceResource extends Resource
{
    protected static ?string $model = Finance::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'مالی مدیریت';

    public static function infolists(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns([
                Infolists\Components\TextEntry::make('name'),
                Tables\Columns\TextColumn::make('email'),
                PhoneEntry::make('phone')->displayFormat(PhoneInputNumberType::NATIONAL),
            ]);
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('Finance')->schema([
                    Forms\Components\RichEditor::make('description')
                        ->label('توضیحات')
                        ->required()
                        ->columnSpanFull(),
                    Grid::make()->schema([
                        Forms\Components\TextInput::make('quantity')
                            ->required()
                            ->label('مقدار')
                            ->live()
                            ->dehydrated()
                            ->default(1)
                            ->numeric(),
                        Forms\Components\TextInput::make('unit')
                            ->required()
                            ->label('فی واحد')
                            ->dehydrated()
                            ->default(1)
                            ->live()
                            ->numeric(),
                        Forms\Components\Placeholder::make('total_price')
                            ->label('مجمعه قیمت')
                            ->content(function ($get) {
                                return $get('quantity') * $get('unit');
                            }),
                        Forms\Components\TextInput::make('dollor')
                            ->required()
                            ->label('دالر')
                            ->live()
                            ->dehydrated()
                            ->numeric(),
                        Forms\Components\TextInput::make('dollor_unit')
                            ->required()
                            ->label('دالر قیمت')
                            ->live()
                            ->default(1)
                            ->numeric(),
                        Forms\Components\Placeholder::make('dollor_total')
                            ->label('مجمعه دالر')
                            ->content(function ($get) {
                                return $get('dollor') * $get('dollor_unit');
                            }),
                        PhoneInput::make('phone_number'),
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('مصرف کننده')
                            ->default(auth()->user()->id)
                            ->required(),
                    ])->columns(6),
                ])->columnSpanFull(),
                // Forms\Components\ViewField::make('total_dollors')
                //     ->label(' دالر مجمعه')
                //     ->view('2'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->searchable()
                    ->label('مقدار')
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit')
                    ->numeric()
                    ->searchable()
                    ->label('فی واحد')
                    ->sortable(),
                Tables\Columns\TextColumn::make('dollor')
                    ->numeric()
                    ->searchable()
                    ->label('دالر')
                    ->sortable(),
                PhoneColumn::make('phone_number')->displayFormat(PhoneInputNumberType::NATIONAL)
                    ->numeric()
                    ->searchable()
                    ->label('شماره تلفن')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->searchable()
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
            'index' => Pages\ListFinances::route('/'),
            'create' => Pages\CreateFinance::route('/create'),
            'view' => Pages\ViewFinance::route('/{record}'),
            'edit' => Pages\EditFinance::route('/{record}/edit'),
        ];
    }
}
