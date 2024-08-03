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
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Enums\FiltersLayout;
use App\Http\Controllers\tarifaController;

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
                            ->label('د نمری (ځمکی) ای ډی')
                            ->autofocus()
                            ->placeholder('د نمری (ځمکی) ای ډی')
                            // ->unique()
                            ->required()
                            ->maxLength(191),
                        Forms\Components\TextInput::make('save_number')
                            ->label('د ثبت نمبر')
                            ->required()
                            // ->disabled()

                            ->prefix('er-')
                            ->placeholder('د ثبت نمبر')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('date')
                            ->label('نیټه')
                            ->default(now()->toDateString())
                            ->placeholder('نیټه')
                            ->required()
                            ->maxLength(191),
                    ])->columns(3),
                    Grid::make()->schema([
                    ]),
                    Forms\Components\TextInput::make('numera_price')
                        ->label('د نمری (ځمکی) قیمت')
                        ->required()
                        ->placeholder('د نمری (ځمکی) قیمت')
                        ->maxLength(191),
                    Forms\Components\TextInput::make('sharwali_tarifa_price')
                        ->label('د ښاروالی د تعرفی پیسی')
                        ->required()
                        ->placeholder('د ښاروالی د تعرفی پیسی')
                        ->maxLength(191),
                ])->columnSpan(6),
                Card::make()->schema([
                    Forms\Components\FileUpload::make('Customer_image')
                        ->label('د مشتری انځور')
                        ->directory('Customer_images')
                        ->preserveFilenames()
                        ->placeholder('د مشتری انځور')
                        ->image()
                        // ->required()
                        ->imageEditor(),
                    Grid::make()->schema([
                        Forms\Components\FileUpload::make('documents')
                            ->directory('Numeraha_documents')
                            ->preserveFilenames()
                            ->downloadable()
                            ->placeholder('اسناد')
                            // ->required()
                            ->label('اسناد'),
                        // Forms\Components\Select::make('customer_id')
                        //     ->label('مشتری')
                        //     ->relationship('Customers', 'name')
                        //     ->preload()
                        //     ->multiple()
                        //     ->required()
                        //     ->createOptionForm([
                        //         Grid::make()->schema([
                        //             Forms\Components\TextInput::make('name')
                        //                 ->required()
                        //                 ->label('نوم')

                        //                 ->maxLength(191),
                        //             Forms\Components\TextInput::make('father_name')
                        //                 ->maxLength(191)
                        //                 ->label('د پلار نوم')
                        //             ,
                        //         ]),
                        //         Grid::make()->schema([
                        //             Forms\Components\TextInput::make('grand_father_name')
                        //                 ->maxLength(191)
                        //                 ->label('د نیکه نوم')
                        //             ,
                        //             Forms\Components\TextInput::make('province')
                        //                 ->maxLength(191)
                        //                 ->label('ولایت')
                        //             ,
                        //         ]),
                        //         Grid::make()->schema([
                        //             Forms\Components\TextInput::make('village')
                        //                 ->maxLength(191)
                        //                 ->label('کلی')
                        //             ,
                        //             Forms\Components\TextInput::make('tazkira')
                        //                 ->maxLength(191)
                        //                 ->label('تذکره نمبر')
                        //             ,
                        //         ]),
                        //         Grid::make()->schema([
                        //             Forms\Components\TextInput::make('mobile_number')
                        //                 ->maxLength(191)
                        //                 ->label('تلفن نمبر')
                        //             ,
                        //             Forms\Components\TextInput::make('parmanent_address')
                        //                 ->maxLength(191)
                        //                 ->label('دایمی داوسیدو پته ')
                        //             ,
                        //         ]),
                        //         Grid::make()->schema([
                        //             Forms\Components\TextInput::make('current_address')
                        //                 ->maxLength(191)
                        //                 ->label('اوسنی داوسیدو پته ')
                        //             ,
                        //             Forms\Components\TextInput::make('job')
                        //                 ->maxLength(191)
                        //                 ->label('وظیفه')
                        //             ,
                        //         ]),
                        //     ]),
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
                Tables\Columns\TextColumn::make('numera_price')
                    ->sortable()
                    ->label('د نمری (ځمکی) قیمت')
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('sharwali_tarifa_price')
                    ->sortable()
                    ->label('د ښاروالی د تعرفی پیسی')
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
                Tables\Columns\TextColumn::make('Customers.name')
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
                        ->relationship('customers', 'name'),
                    // SelectFilter::make('Nullcustomer')
                    //     ->content(function () {

                    //     })
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
                // Action::make('downloadInvoice')
                //     ->label('Download Invoice')
                //     ->url(fn(Numeraha $record) => route('download.invoice', $record->id)) // Use route to generate URL
                //     ->icon('heroicon-o-download')
                //     ->color('primary')
                //     ->requiresConfirmation(),
                // ,


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
