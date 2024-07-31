<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FinanceResource\Pages;
use App\Filament\Resources\FinanceResource\RelationManagers;
use App\Models\Finance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FinanceResource extends Resource
{
    protected static ?string $model = Finance::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'مالی مدیریت';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\RichEditor::make('description')
                    ->label('توضیحات')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->label('مقدار')
                    ->default(1)
                    ->numeric(),
                Forms\Components\TextInput::make('unit')
                    ->required()
                    ->label('فی واحد')
                    ->dehydrated()
                    ->numeric(),
                Forms\Components\TextInput::make('dollor')
                    ->required()
                    ->label('دالر')
                    ->numeric(),
                // Forms\Components\ViewField::make('total_dollors')
                //     ->label(' دالر مجمعه')
                //     ->view('2'),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->label('شماره تلفن')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('مصرف کننده')
                    ->required(),
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
                Tables\Columns\TextColumn::make('phone_number')
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
