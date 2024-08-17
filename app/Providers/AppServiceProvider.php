<?php

namespace App\Providers;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Guava\FilamentKnowledgeBase\Filament\Panels\KnowledgeBasePanel;
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
        FilamentAsset::register([
            Css::make('custom-stylesheet', __DIR__ . '/../../resources/css/custom-rtl.css'),
        ]);
        Schema::defaultStringLength(191);

    }
}
