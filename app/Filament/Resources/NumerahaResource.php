<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NumerahaResource\Pages;
use App\Filament\Resources\NumerahaResource\RelationManagers;
use App\Filament\Resources\NumerahaResource\RelationManagers\CustomersRelationManager;
use App\Models\Numeraha;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Enums\FiltersLayout;

class NumerahaResource extends Resource
{
    protected static ?string $model = Numeraha::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?string $navigationLabel = "مدیریت نمره ها";

    protected static ?string $navigationGroup = 'د ځمکو معاملی';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Grid::make()->schema([
                        Forms\Components\TextInput::make('numero_number')
                            ->label('د نمری نمبر')
                            ->autofocus()
                            ->placeholder('نمری نمبر')
                            ->required()
                            ->maxLength(191),
                        Forms\Components\TextInput::make('save_number')
                            ->label('د ثبت نمبر')
                            ->required()
                            ->maxLength(191),
                    ]),
                    Grid::make()->schema([
                        Forms\Components\TextInput::make('date')
                            ->label('نیټه')
                            ->required()
                            ->maxLength(191),
                        Forms\Components\TextInput::make('tarifa_no')
                            ->label('د تعرفی نمبر')
                            ->required()
                            ->maxLength(191),
                    ]),
                    Forms\Components\TextInput::make('transfered_money_to_bank')
                        ->label('بانک ته لیږل شوی پیسی')
                        ->required()
                        ->maxLength(191),
                ])->columnSpan(6),
                Card::make()->schema([
                    Forms\Components\FileUpload::make('Customer_image')
                        ->label('د مشتری عکس')
                        ->directory('Customer_images')
                        ->preserveFilenames()
                        ->image()
                        ->imageEditor(),
                    Grid::make()->schema([
                        Forms\Components\FileUpload::make('documents')
                            ->directory('Numeraha_documents')
                            ->preserveFilenames()

                            ->label('اسناد'),
                        Forms\Components\Select::make('customer_id')
                            ->label('مشتری')
                            ->relationship('customers', 'name')
                            ->multiple()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                Grid::make()->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->required()
                                        ->label('نوم')

                                        ->maxLength(191),
                                    Forms\Components\TextInput::make('father_name')
                                        ->maxLength(191)
                                        ->label('د پلار نوم')
                                    ,
                                ]),
                                Grid::make()->schema([
                                    Forms\Components\TextInput::make('grand_father_name')
                                        ->maxLength(191)
                                        ->label('د نیکه نوم')
                                    ,
                                    Forms\Components\TextInput::make('province')
                                        ->maxLength(191)
                                        ->label('ولایت')
                                    ,
                                ]),
                                Grid::make()->schema([
                                    Forms\Components\TextInput::make('village')
                                        ->maxLength(191)
                                        ->label('کلی')
                                    ,
                                    Forms\Components\TextInput::make('tazkira')
                                        ->maxLength(191)
                                        ->label('تذکره نمبر')
                                    ,
                                ]),
                                Grid::make()->schema([
                                    Forms\Components\TextInput::make('mobile_number')
                                        ->maxLength(191)
                                        ->label('تلفن نمبر')
                                    ,
                                    Forms\Components\TextInput::make('parmanent_address')
                                        ->maxLength(191)
                                        ->label('دایمی داوسیدو پته ')
                                    ,
                                ]),
                                Grid::make()->schema([
                                    Forms\Components\TextInput::make('current_address')
                                        ->maxLength(191)
                                        ->label('اوسنی داوسیدو پته ')
                                    ,
                                    Forms\Components\TextInput::make('job')
                                        ->maxLength(191)
                                        ->label('وظیفه')
                                    ,
                                ]),
                            ]),
                    ])
                ])->columnSpan(6)
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('numero_number')
                    ->sortable()
                    ->label('د نمری نمبر')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('save_number')
                    ->sortable()
                    ->searchable()
                    ->label('د ثبت نمبر')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('date')
                    ->sortable()
                    ->date()
                    ->label('نیټه')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('tarifa_no')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('د تعرفی نمبر')
                    ->searchable(),
                Tables\Columns\TextColumn::make('transfered_money_to_bank')
                    ->sortable()
                    ->label('بانک ته لیږل شوی پیسی')
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('Customer_image')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('د مشتری عکس')
                ,
                Tables\Columns\TextColumn::make('documents')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('اسناد')
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->numeric()
                    ->sortable()
                    ->label('مشتری')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('د ثبت نیټه')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->date()
                    ->label('د بدلون نیټه')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters(
                [
                    SelectFilter::make('customer')
                        ->relationship('customers', 'name')
                ],
                //  layout: FiltersLayout::AboveContent
            )
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('کتل')
                ,
                Tables\Actions\EditAction::make()
                    ->label('بدلون')
                ,
                Tables\Actions\Action::make('تعرفه')
                    ->icon('heroicon-o-arrow-down-tray')
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
            CustomersRelationManager::class
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
