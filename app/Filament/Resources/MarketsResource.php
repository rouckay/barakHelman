<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarketsResource\Pages;
use App\Filament\Resources\MarketsResource\RelationManagers;
use App\Models\Markets;
use Filament\Forms;
use Filament\Forms\Components\Card;
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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                    Forms\Components\TextInput::make('nomerah_number')
                        ->label('د ځمکی نمبر')
                        ->numeric()
                        ->required()
                        ->maxLength(191),
                    // below the owner should be saved in customer list or not ? 
                    // to make relatoinship with customer table
                    Forms\Components\TextInput::make('nomerah_owner')
                        ->label('د ځمکی مالک ')
                        ->required()
                        ->maxLength(191),
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
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lengthm_m2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nomerah_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nomerah_owner')
                    ->searchable(),
                Tables\Columns\TextColumn::make('owner_phone_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListMarkets::route('/'),
            'create' => Pages\CreateMarkets::route('/create'),
            'view' => Pages\ViewMarkets::route('/{record}'),
            'edit' => Pages\EditMarkets::route('/{record}/edit'),
        ];
    }
}
