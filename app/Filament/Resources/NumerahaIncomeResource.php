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
                Tables\Columns\TextColumn::make('payed_price')
                    ->label('رسید پیسی')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_price')
                    ->label('ټولټال پیسی')
                    ->numeric()
                    ->sortable()
                    ->searchable()
                    ->summarize(Sum::make()->label('ټولټال پیسی')),
                Tables\Columns\TextColumn::make('due_price')
                    ->getStateUsing(fn($record) => $record->total_price - $record->payed_price)
                    ->badge()
                    ->label('باقی پیسی')
                    ->color('success'),
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('د مشتری نوم')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('numeraha.numera_id')
                    ->label('د نمری آی ډی')
                    ->sortable()
                    ->searchable(),
                // Tables\Columns\TextColumn::make('total_price')
                //     ->label('ټولټال پیسی')
                //     ->sortable()
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('payed_price')
                //     ->label('رسید پیسی')
                //     ->sortable()
                //     ->searchable(),
                Tables\Columns\TextColumn::make('first_phase')
                    ->label('لمړی قسط')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('second_phase')
                    ->label('دوهم قسط')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('third_phase')
                    ->label('دریم قسط')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('fourth_phase')
                    ->label('څلورم قسط')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('fifth_phase')
                    ->label('پنځم قسط')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('sixth_phase')
                    ->label('شپژم قسط')
                    ->sortable()
                    ->searchable(),
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
