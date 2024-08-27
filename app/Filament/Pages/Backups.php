<?php

namespace App\Filament\Pages;

use Illuminate\Contracts\Support\Htmlable;
use ShuvroRoy\FilamentSpatieLaravelBackup\Pages\Backups as BaseBackups;
use Illuminate\Support\HtmlString;

class Backups extends BaseBackups
{
    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    public function getHeading(): string|Htmlable
    {
        return 'Application Backups';
    }

    // public static function getNavigationGroup(): ?string
    // {
    //     return 'Core';
    // }
}
