<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarketsResource\Pages;
use App\Filament\Resources\MarketsResource\RelationManagers;
use App\Models\Markets;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MarketsResource extends Resource
{
    protected static ?string $model = Markets::class;
    protected static ?string $navigationLabel = 'مارکیټونو مدیریت';

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    // protected static ?string $title = 'مارکیټونه';
    protected static ?int $navigationSort = 5;
    public static ?string $label = 'مارکیټونه';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Forms\Components\TextInput::make('name')
                        ->label('نوم')
                        ->required()
                        ->maxLength(191),
                    Forms\Components\RichEditor::make('description')
                        ->label('تفصیل')
                        ->required()
                        ->maxLength(191),
                    Forms\Components\TextInput::make('lengthm_m2')
                        ->label('مساحت (متر مربع)')
                        ->required()
                        ->numeric()
                        ->maxLength(191),
                ])->columnSpan(8),
                Card::make()->schema([
                    Forms\Components\Select::make('nomerah_number')
                        ->label('د ځمکی نمبر')
                        ->relationship('numerNumer', 'numero_number')
                        ->searchable()
                        ->selectablePlaceholder()
                        ->required(),
                    // below the owner should be saved in customer list or not ?
                    // to make relatoinship with customer table
                    Forms\Components\Select::make('nomerah_owner')
                        ->label('د ځمکی مالک ')
                        ->required()
                        ->relationship('nomerah_owner', 'name')
                        ->searchable()
                    ,
                    Forms\Components\TextInput::make('owner_phone_number')
                        ->label('د ځمکی د مالک د تلفن شمیره')
                        ->tel()
                        ->required()
                        ->maxLength(191),
                ])->columnSpan(4)
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('row_number')
                    ->label('نمبر')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->label('نوم'),
                Tables\Columns\TextColumn::make('description')
                    ->sortable()
                    ->toggleable()
                    ->label('تفصیل')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lengthm_m2')
                    ->sortable()
                    ->label('مساحت (متر مربع)')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('nomerah_number')
                    ->sortable()
                    ->label('د ځمکی نمبر')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('nomerah_owner')
                    ->sortable()
                    ->toggleable()
                    ->label('د ځمکی مالک ')
                    ->searchable(),
                Tables\Columns\TextColumn::make('owner_phone_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('د ثبت نیټه ')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('د بدلون نیټه')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
            'index' => Pages\ListMarkets::route('/'),
            'create' => Pages\CreateMarkets::route('/create'),
            'view' => Pages\ViewMarkets::route('/{record}'),
            'edit' => Pages\EditMarkets::route('/{record}/edit'),
        ];
    }
}
