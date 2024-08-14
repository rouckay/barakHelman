<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerNumerahaResource\Pages;
use App\Filament\Resources\CustomerNumerahaResource\RelationManagers;
use App\Filament\Resources\CustomerNumerahaResource\RelationManagers\CustomersRelationManager;
use App\Models\CustomerNumeraha;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerNumerahaResource extends Resource
{
    protected static ?string $model = CustomerNumeraha::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrow-path-rounded-square';

    protected static ?string $navigationLabel = 'د نمرو معاملی';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->label('Customer')
                    ->relationship('customer', 'name') // 'customer' is the relationship method in CustomerNumeraha model
                    ->searchable()
                    ->searchable()
                    ->preload()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('numeraha_id')
                    ->label('Numeraha')
                    ->relationship('numeraha', 'numero_number') // 'numeraha' is the relationship method in CustomerNumeraha model
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\FileUpload::make('documents')
                    ->directory('customer_numeraha')
                    ->preserveFilenames()
                    ->downloadable()
                    ->placeholder('اسناد')
                    // ->multiple()
                    ->openable()
                    ->uploadingMessage('فایل شما در حال اپلود به دیتابیس هست...')
                    ->previewable()
                    // ->minFiles(1)
                    // ->maxFiles(5)
                    // ->required()
                    ->label('د ځمکی اسناد')
                    ->required()
                ,
                Forms\Components\TextInput::make('remarks')
                    ->maxLength(191),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('numeraha_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('documents')
                    ->searchable(),
                Tables\Columns\TextColumn::make('remarks')
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
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomerNumerahas::route('/'),
            'create' => Pages\CreateCustomerNumeraha::route('/create'),
            'view' => Pages\ViewCustomerNumeraha::route('/{record}'),
            'edit' => Pages\EditCustomerNumeraha::route('/{record}/edit'),
        ];
    }
}
