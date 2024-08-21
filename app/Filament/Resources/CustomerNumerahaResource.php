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
                Forms\Components\Select::make('customer_id')
                    ->label('Customer')
                    ->relationship('customer', 'name') // 'customer' is the relationship method in CustomerNumeraha model
                    ->searchable()
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('numeraha_id')
                    ->label('Numeraha')
                    ->relationship('numeraha', 'save_number') // 'numeraha' is the relationship method in CustomerNumeraha model
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\FileUpload::make('documents')
                    ->directory('customer_numeraha')
                    ->preserveFilenames()
                    ->downloadable()
                    // ->multiple()
                    ->placeholder('اسناد')
                    // ->multiple()
                    ->openable()
                    ->uploadingMessage('فایل شما در حال اپلود به دیتابیس هست...')
                    ->previewable()
                    // ->minFiles(1)
                    // ->maxFiles(5)
                    // ->required()
                    ->label('د ځمکی اسناد')
                    ->required(),
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
