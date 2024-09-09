<?php

namespace App\Filament\Resources;

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
class NumerahaIncomeResource extends Resource
{
    protected static ?string $model = CustomerNumeraha::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'عواید';
    protected static ?string $navigationGroup = "ادارې مدیریت برخه";

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
                    ->searchable(),
                Tables\Columns\TextColumn::make('due_price')
                    ->getStateUsing(fn($record) => $record->total_price - $record->payed_price)
                    ->badge()
                    ->label('باقی پیسی')
                    ->color('success'),
            ])
            ->filters([
                // Define any filters you want to apply
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
