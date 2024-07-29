<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomersResource\Pages;
use App\Filament\Resources\CustomersResource\RelationManagers;
use App\Models\Customers;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomersResource extends Resource
{
    protected static ?string $model = Customers::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'مشتریان';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Grid::make()->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('نوم')
                            ->required()
                            ->maxLength(191),
                        Forms\Components\TextInput::make('father_name')
                            ->label('د پلار نوم')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('grand_father_name')
                            ->label('د نیکه نوم')
                            ->maxLength(191),
                        Forms\Components\Select::make('province')
                            ->label('ولایت')
                            ->options([
                                'Badakhshan' => 'Badakhshan',
                                'Badghis' => 'Badghis',
                                'Baghlan' => 'Baghlan',
                                'Balkh' => 'Balkh',
                                'Bamyan' => 'Bamyan',
                                'Daykundi' => 'Daykundi',
                                'Farah' => 'Farah',
                                'Faryab' => 'Faryab',
                                'Ghazni' => 'Ghazni',
                                'Ghor' => 'Ghor',
                                'Helmand' => 'Helmand',
                                'Herat' => 'Herat',
                                'Jowzjan' => 'Jowzjan',
                                'Kabul' => 'Kabul',
                                'Kandahar' => 'Kandahar',
                                'Kapisa' => 'Kapisa',
                                'Khost' => 'Khost',
                                'Kunar' => 'Kunar',
                                'Kunduz' => 'Kunduz',
                                'Laghman' => 'Laghman',
                                'Logar' => 'Logar',
                                'Nangarhar' => 'Nangarhar',
                                'Nimroz' => 'Nimroz',
                                'Nuristan' => 'Nuristan',
                                'Panjshir' => 'Panjshir',
                                'Parwan' => 'Parwan',
                                'Samangan' => 'Samangan',
                                'Sar-e Pol' => 'Sar-e Pol',
                                'Takhar' => 'Takhar',
                                'Urozgan' => 'Urozgan',
                                'Wardak' => 'Wardak',
                                'Zabul' => 'Zabul'
                            ]),
                        Forms\Components\TextInput::make('village')
                            ->label('کلی')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('tazkira')
                            ->label('تذکره نمبر')
                            ->maxLength(191),
                    ])->columnSpan(6),
                    Grid::make()->schema([
                        Forms\Components\TextInput::make('mobile_number')
                            ->label('تلفن نمبر')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('parmanent_address')
                            ->label('دایمی داوسیدو پته ')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('current_address')
                            ->label('اوسنی داوسیدو پته ')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('job')
                            ->label('وظیفه')
                            ->maxLength(191),
                    ])->columnSpan(6)
                ])->columns(12)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('father_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('grand_father_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('province')
                    ->searchable(),
                Tables\Columns\TextColumn::make('village')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tazkira')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mobile_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('parmanent_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('current_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('job')
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomers::route('/create'),
            'view' => Pages\ViewCustomers::route('/{record}'),
            'edit' => Pages\EditCustomers::route('/{record}/edit'),
        ];
    }
}
