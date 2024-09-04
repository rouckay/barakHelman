<?php

namespace App\Providers;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Guava\FilamentKnowledgeBase\Filament\Panels\KnowledgeBasePanel;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */


    public function register(): void
    {

        KnowledgeBasePanel::configureUsing(
            fn(KnowledgeBasePanel $panel) => $panel
                ->viteTheme('resources/css/filament/admin/theme.css') // your filament vite theme path here
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['per', 'en', 'ps']); // also accepts a closure
        });
        Schema::defaultStringLength(191);

    }
}
