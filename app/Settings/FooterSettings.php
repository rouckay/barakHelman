<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class FooterSettings extends Settings
{

    public static function group(): string
    {
        return 'FooterSettings';
    }
}