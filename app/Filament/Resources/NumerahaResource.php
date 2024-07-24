<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NumerahaResource\Pages;
use App\Filament\Resources\NumerahaResource\RelationManagers;
use App\Models\Numeraha;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NumerahaResource extends Resource
{
    protected static ?string $model = Numeraha::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?string $navigationLabel = "مدیریت نمره ها";
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('numero_number')
                    ->label('د نمری نمبر')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('save_number')
                    ->label('د ثبت نمبر')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('date')
                    ->label('تاریخ')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('tarifa_no')
                    ->label('د تعرفی نمبر')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('transfered_money_to_bank')
                    ->label('بانک ته لیږل شوی پیسی')
                    ->required()
                    ->maxLength(191),
                Forms\Components\FileUpload::make('Customer_image')
                    ->label('د مشتری عکس')
                    ->image()
                    ->required(),
                Forms\Components\FileUpload::make('documents')
                    ->label('اسناد')
                    ->required(),
                Forms\Components\Select::make('customer_id')
                    ->label('مشتری')
                    ->relationship('customer', 'name')
                    ->required()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(191),
                        Forms\Components\TextInput::make('father_name')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('grand_father_name')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('province')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('village')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('tazkira')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('mobile_number')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('parmanent_address')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('current_address')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('job')
                            ->maxLength(191),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('numero_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('save_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tarifa_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('transfered_money_to_bank')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('Customer_image'),
                Tables\Columns\TextColumn::make('documents')
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer_id')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListNumerahas::route('/'),
            'create' => Pages\CreateNumeraha::route('/create'),
            'view' => Pages\ViewNumeraha::route('/{record}'),
            'edit' => Pages\EditNumeraha::route('/{record}/edit'),
        ];
    }
}
