<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NumerahaResource\Pages;
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
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\Button;
use App\Filament\Exports\ProductExporter;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions;
use EightyNine\ExcelImport\ExcelImportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;
use App\Models\CustomerNumeraha;
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;
use Okeonline\FilamentArchivable\Tables\Filters\ArchivedFilter;
use Okeonline\FilamentArchivable\Tables\Actions\ArchiveAction;
use Okeonline\FilamentArchivable\Tables\Actions\UnArchiveAction;
use LaravelArchivable\Scopes\ArchivableScope;
use Filament\Tables\Columns\Summarizers\Sum;

class NumerahaResource extends Resource
{
    protected static ?string $model = Numeraha::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?string $navigationLabel = "د نمرو مکمل لیست";
    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static ?string $label = 'نمری (ځمکی)';

    // custome code for saving data

    // Add this method in the appropriate place (e.g., Filament Resource or Table class)

    protected function handleExcelImport($records)
    {
        // Define your import logic here
        foreach ($records as $record) {
            // Process each record, e.g., save to the database
        }
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class, // only if soft deleting is also active, otherwise it can be ommitted
                ArchivableScope::class,
            ]);
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Grid::make()->schema([
                        Forms\Components\TextInput::make('numera_id')
                            ->label('د نمری آی ډی')
                            ->unique(ignoreRecord: true)
                            ->default('GM-' . Str::substr((string) Str::uuid(), 0, 8)) // Auto-generate a unique save number
                            ->disabled()
                            ->prefixIcon('heroicon-o-sparkles')
                            ->required(),
                        Forms\Components\TextInput::make('Land_Area')
                            ->label('د نمری (ځمکی) مساحت')
                            ->placeholder('د نمری (ځمکی) مساحت')
                            ->numeric()
                            ->prefix(' متر مربع (m2)')
                            ->autofocus()
                            ->required()
                            ->maxLength(191),
                    ])->columns(2),
                    Forms\Components\RichEditor::make('description')
                        ->label('اضافه معلومات')
                        ->placeholder('اضافه معلومات')
                        ->maxLength(1000),
                ])->columnSpan(6),
                Card::make()->schema([
                    // Grid::make()->schema([
                    // ]),
                    Grid::make()->schema([
                        Forms\Components\TextInput::make('north')
                            ->label('شمال')
                            ->required()
                            ->placeholder('د نمری (ځمکی) شمال طرف')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('south')
                            ->label('جنوب')
                            ->required()
                            ->placeholder('د نمری (ځمکی) جنوب طرف')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('east')
                            ->label('شمال')
                            ->required()
                            ->placeholder('د نمری (ځمکی) شرق طرف')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('west')
                            ->label('غرب')
                            ->required()
                            ->placeholder('د نمری (ځمکی) غرب طرف')
                            ->maxLength(191),
                        Forms\Components\Select::make('numera_type')
                            ->label('د نمری (ځمکی) تفصیل')
                            ->placeholder('د نمری (ځمکی) تفصیل')
                            ->prefixIcon('heroicon-o-chat-bubble-bottom-center-text')
                            ->options([
                                '10 بسوه ای' => '10 بسوه ای',
                                '9 بسوه ای' => '9 بسوه ای',
                                '8 بسوه ای' => '8 بسوه ای',
                                '7 بسوه ای' => '7 بسوه ای',
                                '6 بسوه ای' => '6 بسوه ای',
                                '5 بسوه ای' => '5 بسوه ای',
                                '4 بسوه ای' => '4 بسوه ای',
                                '3 بسوه ای' => '3 بسوه ای',
                                '2.5 بسوه ای' => '2.5 بسوه ای',
                                'بلندـمنزل' => 'بلند منزل',
                            ])
                            ->required()
                            ->searchable(),
                        Forms\Components\TextInput::make('date')
                            ->label('نیټه')
                            ->default(now()->toDateString())
                            ->placeholder('نیټه')
                            ->prefixIcon('heroicon-o-calendar-days')
                            ->required()
                            ->maxLength(191),
                    ])->columns(2),
                    // Forms\Components\FileUpload::make('documents')
                    //     ->directory('Numeraha_documents')
                    //     ->preserveFilenames()
                    //     ->downloadable()
                    //     // ->multiple()
                    //     ->rules('required|array') // validate as an array
                    //     ->placeholder('اسناد')
                    //     // ->multiple()
                    //     ->openable()
                    //     ->uploadingMessage('فایل شما در حال اپلود به دیتابیس هست...')
                    //     ->previewable()
                    //     // ->minFiles(1)
                    //     // ->maxFiles(5)
                    //     // ->required()
                    //     ->label('د ځمکی اسناد'),
                ])->columnSpan(6)
            ])->columns(12);
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('row_number')
                    ->label('نمبر')
                    ->rowIndex(),
                // Tables\Columns\TextColumn::make('numeraha.payed_price')
                //     ->label('رسید پیسی')
                //     ->numeric()
                //     ->sortable()
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('numeraha.total_price')
                //     ->label('ټولټال پیسی')
                //     ->numeric()
                //     ->sortable()
                //     ->searchable()
                //     ->summarize(Sum::make()->label('ټولټال پیسی')),
                // Tables\Columns\TextColumn::make('due_price')
                //     ->getStateUsing(fn($record) => $record->total_price - $record->payed_price)
                //     ->badge()
                //     ->label('باقی پیسی')
                //     ->color('success'),
                // Tables\Columns\TextColumn::make('customer.name')
                //     ->label('د مشتری نوم')
                //     ->sortable()
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('numeraha.numera_id')
                //     ->label('د نمری آی ډی')
                //     ->sortable()
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('first_phase')
                //     ->label('لمړی قسط')
                //     ->sortable()
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('second_phase')
                //     ->label('دوهم قسط')
                //     ->sortable()
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('third_phase')
                //     ->label('دریم قسط')
                //     ->sortable()
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('fourth_phase')
                //     ->label('څلورم قسط')
                //     ->sortable()
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('fifth_phase')
                //     ->label('پنځم قسط')
                //     ->sortable()
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('sixth_phase')
                //     ->label('شپژم قسط')
                //     ->sortable()
                //     ->searchable(),
                //////////////////////////////////////////////////////////////////
                Tables\Columns\TextColumn::make('numera_id')
                    ->sortable()
                    ->toggleable(),
                BadgeableColumn::make('numera_id')
                    ->label('د نمری آی ډی')
                    ->searchable()
                    ->suffixBadges([
                        Badge::make('hot')
                            ->label(fn($record) => ' مشتریان: ' . $record->customers()->count())
                            ->color('success')
                            ->visible(fn($record) => $record->customers()->count() > 0),
                    ]),
                Tables\Columns\TextColumn::make('numera_type')
                    ->sortable()
                    ->label(' تفصیل')
                    ->searchable()
                    ->toggleable()
                ,
                Tables\Columns\TextColumn::make('Land_Area')
                    ->sortable()
                    ->label('د نمری مساحت')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('description')
                    ->sortable()
                    ->label('ملاحظات')
                    ->searchable()
                    ->toggleable()
                    ->html()
                ,
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('د ثبت نیټه')
                    ->date()
                    ->since()
                    ->dateTimeTooltip()
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
                    ArchivedFilter::make(),
                    // SelectFilter::make('customer')
                    //     ->label('به اساس مشتری')
                    //     ->relationship('customers', 'name'),
                    //  layout: FiltersLayout::AboveContent
                    TernaryFilter::make('پلورل شوی نمری (ځمکی)')
                        ->label('د نمرو (ځمکو) فلتر')
                        ->placeholder('د فلتر انتخاب')
                        ->trueLabel('پلورل شوی نمری (ځمکی)')
                        ->falseLabel(' هغه نمری (ځمکی) جی ندی پلورل شوی.')
                        ->queries(
                            true: fn(Builder $query) => $query->whereHas('customers'),
                            false: fn(Builder $query) => $query->whereDoesntHave('customers')
                        ),
                    // Filter::make('هغه نمری (ځمکی) چی نه دی پلورل شوی.')
                    //     ->query(fn(Builder $query) => $query->where(function ($query) {
                    //         $query->where('customer_id', '=', 0)
                    //             ->orWhereNull('customer_id');
                    //     })),
                ]
            )
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('کتل')
                ,
                Tables\Actions\EditAction::make()
                    ->label('بدلون')
                ,
                // ExportAction::make()
                //     ->label('ډنلوډ کول')
                //     ->color('success')
                //     ->icon('heroicon-o-document-arrow-down')
                //     ->exports([
                //         ExcelExport::make()->withColumns([
                //             Column::make('numero_number'),
                //             Column::make('save_number'),
                //             Column::make('date'),
                //             Column::make('numera_price'),
                //             Column::make('sharwali_tarifa_price'),
                //             Column::make('Customer_image'),
                //             Column::make('documents'),
                //             // Column::make('created_at'),
                //             // Column::make('updated_at'),
                //             // Column::make('customer_id'),
                //             Column::make('numera_type'),
                //         ]),
                //     ]),
                ArchiveAction::make()
                    ->label('آرشیف کړی'),
                UnArchiveAction::make()
                    ->label('آرشیف نه حذف کړی'),
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
