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
class NumerahaResource extends Resource
{
    protected static ?string $model = Numeraha::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?string $navigationLabel = "د نمرو (ځمکو) مدیریت";
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    protected static ?int $navigationSort = 1;
    public static ?string $label = 'نمری (ځمکی)';


    // protected static ?string $navigationGroup = 'د ځمکو معاملی';

    // Add this method in the appropriate place (e.g., Filament Resource or Table class)

    protected function handleExcelImport($records)
    {
        // Define your import logic here
        foreach ($records as $record) {
            // Process each record, e.g., save to the database
        }
    }
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
                            ->numeric()
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->maxLength(191),
                        Forms\Components\TextInput::make('save_number')
                            ->label('د ثبت نمبر')
                            ->default('NGMAM-' . Str::uuid()->toString()) // Auto-generate a unique save number
                            // ->disabled()
                            ->required(),
                    ])->columns(2),
                    Grid::make()->schema([
                        Forms\Components\TextInput::make('date')
                            ->label('نیټه')
                            ->default(now()->toDateString())
                            ->placeholder('نیټه')
                            ->required()
                            ->maxLength(191),
                        Forms\Components\TextInput::make('numera_price')
                            ->label('د نمری (ځمکی) قیمت')
                            ->required()
                            ->numeric()
                            ->placeholder('د نمری (ځمکی) قیمت')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('sharwali_tarifa_price')
                            ->label('د ښاروالی د تعرفی پیسی')
                            ->required()
                            ->numeric()
                            ->placeholder('د ښاروالی د تعرفی پیسی')
                            ->maxLength(191),
                    ])->columns(3),
                ])->columnSpan(6),
                Card::make()->schema([
                    // Grid::make()->schema([
                    // ]),
                    Forms\Components\Select::make('numera_type')
                        ->label('د نمری (ځمکی) تفصیل')
                        ->placeholder('د نمری (ځمکی) تفصیل')
                        ->options([
                            '3 بسوه ای' => '3 بسوه ای',
                            '2 بسوه ای' => '2 بسوه ای',
                            '1 بسوه ای' => '1 بسوه ای',
                        ])
                        ->required()
                        ->searchable(),
                    Forms\Components\FileUpload::make('documents')
                        ->directory('Numeraha_documents')
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
                        ->label('د ځمکی اسناد'),
                ])->columnSpan(6)
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('row_number')
                    ->label('نمبر')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('numero_number')
                    ->sortable()
                    ->label('د نمری (ځمکی) ای ډی')
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
                // Tables\Columns\TextColumn::make('Customers')
                //     ->numeric()
                //     ->sortable()
                //     ->label('مشتری')
                //     ->toggleable(isToggledHiddenByDefault: true),
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
                            true: fn(Builder $query) => CustomerNumeraha::query()->where('customer_id', '>=', 1),
                            false: fn(Builder $query) => CustomerNumeraha::query()->where('customer_id', '=', 0) // No condition applied when false
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
                Tables\Actions\ButtonAction::make('downloadInvoice')
                    ->label('تعرفه ترلاسه کړی')
                    ->url(fn(Numeraha $record) => route('download.invoice', $record)) // Use route to generate URL
                    ->icon('heroicon-o-printer')
                    ->color('primary')
                    ->requiresConfirmation(),
                ExportAction::make()
                    ->label('ډنلوډ کول')
                    ->color('success')
                    ->icon('heroicon-o-document-arrow-down')
                    ->exports([
                        ExcelExport::make()->withColumns([
                            Column::make('numero_number'),
                            Column::make('save_number'),
                            Column::make('date'),
                            Column::make('numera_price'),
                            Column::make('sharwali_tarifa_price'),
                            Column::make('Customer_image'),
                            Column::make('documents'),
                            // Column::make('created_at'),
                            // Column::make('updated_at'),
                            // Column::make('customer_id'),
                            Column::make('numera_type'),
                        ]),
                    ])
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
