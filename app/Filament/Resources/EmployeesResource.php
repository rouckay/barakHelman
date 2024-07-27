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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('salary')
                            ->label('معاش ')
                            ->required()
                            ->numeric()
                            ->maxLength(191),
                        Forms\Components\TextInput::make('tazkira')
                            ->label('تذکره')
                            ->required()
                            ->numeric()
                            ->maxLength(191),
                    ]),
                    Grid::make(2)->schema([
                        Forms\Components\DatePicker::make('date_of_contract')
                            ->label('تاریخ قرارداد')
                            ->required()
                        ,
                        Forms\Components\DatePicker::make('end_date_of_contract')
                            ->label('تاریخ ختم قرارداد')
                            ->required()
                    ]),
                    Forms\Components\TextInput::make('phone_number')
                        ->label('شماره تلفن')
                        ->tel()
                        ->required()
                        ->maxLength(191),
                    Forms\Components\Textarea::make('Address')
                        ->label('پته / آدرس')
                        ->required()
                        ->maxLength(191),
                ])->columnSpan(8),
                Card::make()->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('نوم')
                            ->required()
                            ->maxLength(191),
                        Forms\Components\TextInput::make('lastName')
                            ->label('تخلص')
                            ->required()
                            ->maxLength(191),
                    ]),
                    Forms\Components\TextInput::make('FatherName')
                        ->label('د پلار نوم')
                        ->required()
                        ->maxLength(191),
                    Forms\Components\TextInput::make('Position')
                        ->label('بست')
                        ->required()
                        ->maxLength(191),
                    Forms\Components\TextInput::make('Education')
                        ->label('زده کړې')
                        ->required()
                        ->maxLength(191),
                ])->columnSpan(4),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('نوم')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('lastName')
                    ->label('تخلص')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('FatherName')
                    ->label('د پلار نوم')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('Position')
                    ->label('بست')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('Education')
                    ->label('زده کړې')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('salary')
                    ->label('معاش ')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tazkira')
                    ->label('تذکره')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_of_contract')
                    ->label('تاریخ قرارداد')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('end_date_of_contract')
                    ->label('تاریخ ختم قرارداد')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('شماره تلفن')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('Address')
                    ->label('پته / آدرس')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('ثبت تاریخ')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('د تغیر تاریخ')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([

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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployees::route('/create'),
            'view' => Pages\ViewEmployees::route('/{record}'),
            'edit' => Pages\EditEmployees::route('/{record}/edit'),
        ];
    }
}
