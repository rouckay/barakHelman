<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-m-user';
    protected static ?string $navigationGroup = 'ډیټابیس مدیریان';
    protected static ?string $navigationLabel = 'کاربران';
    protected static ?string $recordTitleAttribute = 'name';
    public static ?string $label = 'مدیران';

    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Grid::make()->schema([

                        Forms\Components\TextInput::make('name')
                            ->label('نام')
                            ->required()
                            ->placeholder('نام')
                            ->prefixIcon('heroicon-o-user')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->prefixIcon('')
                            ->label('ایمیل آدرس')
                            ->placeholder('ایمیل آدرس')
                            ->required()
                            ->maxLength(191),
                        Forms\Components\DateTimePicker::make('email_verified_at'),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->placeholder('*********')
                            ->prefixIcon('')
                            ->label('پټ نوم')
                            ->required()
                            ->maxLength(191),
                        Forms\Components\TextInput::make('lang')
                            ->required()
                            ->prefixIcon('heroicon-m-globe-alt')
                            ->placeholder('ژبه')
                            ->maxLength(191)
                            ->default('en'),
                    ])->columns(5)
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('row_number')
                    ->label('نمبر')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('نوم')
                    ->toggleable()
                ,
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label('ایمیل آدرس')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->label('ایمیل تایید شوی په')
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('د ثبت نیټه ')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('د بدلون نیټه')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('lang')
                    ->searchable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
