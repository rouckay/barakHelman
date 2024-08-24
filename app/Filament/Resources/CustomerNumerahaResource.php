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
use Illuminate\Support\HtmlString;

class CustomerNumerahaResource extends Resource
{
    protected static ?string $model = CustomerNumeraha::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrow-path-rounded-square';

    protected static ?string $navigationGroup = "د نمرو (ځمکو) مدیریت";

    protected static ?string $navigationLabel = 'د نمرو د پلورل';

    public static ?string $label = 'نمری (ځمکی) پلورل';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\Grid::make()->schema([
                        Forms\Components\Select::make('customer_id')
                            ->label('مشتری')
                            ->relationship('customer', 'name') // 'customer' is the relationship method in CustomerNumeraha model
                            ->searchable()
                            ->placeholder('خپل مشتری انتخاب کړی')
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('numeraha_id')
                            ->label('نمره (ځمکه)')
                            ->relationship('numeraha', 'save_number') // 'numeraha' is the relationship method in CustomerNumeraha model
                            ->searchable()
                            ->placeholder('د مشتری د پاره ځمکه انتخاب کړی')
                            ->preload()
                            ->required(),
                    ])->columns(2),
                    Forms\Components\RichEditor::make('remarks')
                        ->label('اضافه معلومات')
                        ->placeholder('د ځمکی په باره که اضافه معلومات مو دلته اضافه کړی')
                        ->maxLength(191),
                ])->columnSpan(6),
                Forms\Components\Card::make()->schema([
                    // Forms\Components\Repeater::make('documents')->schema([
                    Forms\Components\FileUpload::make('multipleDocs')
                        ->directory('customer_numeraha')
                        ->preserveFilenames()
                        ->downloadable()
                        ->multiple()
                        ->placeholder('ټول آسناد')
                        ->openable()
                        ->uploadingMessage('فایل شما در حال اپلود به دیتابیس هست...')
                        ->previewable()
                        // ->minFiles(1)
                        ->maxFiles(5)
                        ->acceptedFileTypes(['application/pdf', 'image/*'])
                        ->required()
                        ->label('د ځمکی اسناد')
                        ->required(),
                    // ]),
                    Forms\Components\FileUpload::make('Responsible_Person_Img')
                        ->directory('customer_Responsible_images')
                        ->preserveFilenames()
                        ->downloadable()
                        ->placeholder('تصویر د مشتری وکیل')
                        ->openable()
                        ->uploadingMessage('ستاسی تصویر د اپلوډ په حال کی دی...')
                        ->previewable()
                        ->image()
                        // ->required()
                        ->label('د مشتری وکیل')
                        ->required(),
                    Forms\components\Grid::make()->schema([
                        Forms\Components\TextInput::make('first_phase')
                            ->label('لمړی قست')
                            ->required()
                            ->numeric()
                            ->prefixIcon('heroicon-o-banknotes')
                            ->placeholder('لمړی قست')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('second_phase')
                            ->label('دوهم قست')
                            ->required()
                            ->numeric()
                            ->prefixIcon('heroicon-o-banknotes')
                            ->placeholder('دوهم قست')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('third_phase')
                            ->label('دریم قست')
                            ->required()
                            ->numeric()
                            ->prefixIcon('heroicon-o-banknotes')
                            ->placeholder('دریم قست')
                            ->maxLength(191)
                    ])->columns(3),
                    Forms\components\Grid::make()->schema([
                        Forms\Components\TextInput::make('fourth_phase')
                            ->label('څلورم قست')
                            ->required()
                            ->numeric()
                            ->prefixIcon('heroicon-o-banknotes')
                            ->placeholder('څلورم قست')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('fifth_phase')
                            ->label('پنځم قست')
                            ->required()
                            ->numeric()
                            ->prefixIcon('heroicon-o-banknotes')
                            ->placeholder('پنځم قست')
                            ->maxLength(191),
                    ])->columns(2),
                    Forms\Components\Grid::make()->schema([
                        Forms\Components\TextInput::make('payed_price')->label('رسید پیسی')
                            ->live()
                            ->default(1)
                            ->numeric()
                            ->prefixIcon('heroicon-o-banknotes')
                            ->dehydrated(),
                        Forms\Components\TextInput::make('total_price')
                            ->live()
                            ->prefixIcon('heroicon-o-banknotes')
                            ->default(1)
                            ->numeric()
                            ->label('محمعه پیسی'),
                        Forms\Components\Placeholder::make('due_price')
                            ->label('باقی پیسی')
                            ->disabled()
                            ->content(function ($get) {
                                $payed_price = $get('payed_price');
                                $total_price = $get('total_price');
                                if (!is_numeric($payed_price) || !is_numeric($total_price)) {
                                    return new HtmlString('<p style="color:red;border:2px solid red; padding:3px;border-radius:10px"><strong>مهربانی وکړی یوازې عددي ارزښتونه اضافه کړی!</strong></p>');

                                } else if ($payed_price <= 0 || $total_price <= 0) {
                                    return new HtmlString('<p style="color:red;border:2px solid red; padding:3px;border-radius:10px"><strong>مهربانی وکړی د 1 څخه جګ عدد انتخاب کړی!</strong></p>');
                                }
                                return $total_price - $payed_price;
                            }),
                    ])->columns(3),
                ])->columnSpan(6),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')
                    ->numeric()
                    ->label('نوم د مشتری')
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('numeraha_id')
                    ->numeric()
                    ->toggleable()
                    ->label('د نمری (ځمکی) آی ډی')
                    ->sortable(),
                Tables\Columns\TextColumn::make('multipleDocs')
                    ->searchable()
                    ->label('د نمری (ځمکی) اسناد')
                    ->toggleable()
                ,
                Tables\Columns\TextColumn::make('remarks')
                    ->toggleable()
                    ->label('اضافه معلومات')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('د ثبت نیټه ')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('د بدلون نیټه')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('کتل'),
                Tables\Actions\EditAction::make()
                    ->label('بدلون'),
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
