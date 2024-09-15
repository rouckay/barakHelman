<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeesResource\Pages;
use App\Filament\Resources\EmployeesResource\RelationManagers;
use App\Models\Employees;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeesResource extends Resource
{
    protected static ?string $model = Employees::class;
    protected static ?string $navigationLabel = "کارمندان";

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationGroup = 'ډیټابیس مدیریان';

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?int $navigationSort = 10;

    public static ?string $label = 'کارمندان';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('نوم')
                            ->placeholder('نوم')
                            ->prefixIcon('heroicon-o-user')
                            ->required()
                            ->maxLength(191),
                        Forms\Components\TextInput::make('lastName')
                            ->label('تخلص')
                            ->prefixIcon('heroicon-o-user')
                            ->placeholder('تخلص')
                            ->required()
                            ->maxLength(191),
                    ]),
                    Forms\Components\TextInput::make('FatherName')
                        ->label('د پلار نوم')
                        ->prefixIcon('heroicon-o-user')
                        ->placeholder('د پلار نوم')
                        ->required()
                        ->maxLength(191),
                    Forms\Components\TextInput::make('Position')
                        ->label('بست')
                        ->placeholder('بست')
                        ->prefixIcon('heroicon-o-briefcase')
                        ->required()
                        ->maxLength(191),
                    Forms\Components\TextInput::make('Education')
                        ->label('زده کړې')
                        ->placeholder('زده کړې')
                        ->prefixIcon('heroicon-o-briefcase')
                        ->required()
                        ->maxLength(191),
                ])->columnSpan(4),
                Card::make()->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('salary')
                            ->label('معاش ')
                            ->required()
                            ->prefixIcon('heroicon-o-banknotes')
                            ->placeholder('معاش')
                            ->numeric()
                            ->maxLength(191),
                        Forms\Components\TextInput::make('tazkira')
                            ->label('تذکره')
                            ->required()
                            ->prefixIcon('heroicon-o-identification')
                            ->placeholder('تذکره')
                            ->numeric()
                            ->maxLength(191),
                    ]),
                    Grid::make(2)->schema([
                        Forms\Components\DatePicker::make('date_of_contract')
                            ->label('تاریخ قرارداد')
                            ->placeholder('تاریخ قرارداد')
                            ->default(now()->toDateString())
                            ->required()
                        ,
                        Forms\Components\DatePicker::make('end_date_of_contract')
                            ->label('تاریخ ختم قرارداد')
                            ->placeholder('تاریخ ختم قرارداد')
                            ->default(now()->toDateString())
                            ->required()
                    ]),
                    Grid::make()->schema([
                        Forms\Components\TextInput::make('phone_number')
                            ->label('شماره تلفن')
                            ->placeholder('شماره تلفن')
                            ->tel()
                            ->prefixIcon('heroicon-o-phone')
                            ->required()
                            ->maxLength(191),
                        Forms\Components\Textarea::make('Address')
                            ->label('پته / آدرس')
                            ->placeholder('پته / آدرس')
                            ->required()
                            ->maxLength(191),
                    ])
                ])->columnSpan(8),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('row_number')
                    ->label('نمبر')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('name')
                    ->label('نوم')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('lastName')
                    ->label('تخلص')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('FatherName')
                    ->label('د پلار نوم')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('Position')
                    ->label('بست')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('Education')
                    ->label('زده کړې')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('salary')
                    ->label('معاش ')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tazkira')
                    ->label('تذکره')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('date_of_contract')
                    ->label('تاریخ قرارداد')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('end_date_of_contract')
                    ->label('تاریخ ختم قرارداد')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('شماره تلفن')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('Address')
                    ->label('پته / آدرس')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('د ثبت نیټه ')
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->dateTimeTooltip()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('د بدلون نیټه')
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->dateTimeTooltip()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([

            ])
            ->actions([
                \Filament\Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->label('کتل')
                    ,
                    Tables\Actions\EditAction::make()
                        ->label('بدلون')
                    ,
                ]),
                Tables\Actions\ViewAction::make()
                    ->label('کتل')
                ,
                Tables\Actions\EditAction::make()
                    ->label('بدلون')
                ,
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployees::route('/create'),
            'view' => Pages\ViewEmployees::route('/{record}'),
            'edit' => Pages\EditEmployees::route('/{record}/edit'),
        ];
    }
}
