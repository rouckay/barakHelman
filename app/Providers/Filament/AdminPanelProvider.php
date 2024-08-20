<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use EightyNine\Reports\ReportsPlugin;
use Awcodes\Overlook\OverlookPlugin;
use Awcodes\Overlook\Widgets\OverlookWidget;
use Guava\FilamentKnowledgeBase\KnowledgeBasePlugin;
class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->profile()
            ->login()
            ->colors([
                'primary' => Color::Green,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            // ->sidebarFullyCollapsibleOnDesktop()
            ->sidebarCollapsibleOnDesktop()
            ->navigationItems([
                // NavigationItem::make('Settings')
                //     ->icon('heroicon-m-cog')
                //     ->isActiveWhen(fn() => request()->route()->getName() === 'filament.admin.resources.settings.index')
                //     ->url('/admin/settings'),
                NavigationItem::make('د ځمکو مدیریت')
                    ->icon('heroicon-m-cog')
                    ->isActiveWhen(fn() => request()->route()->getName() === 'filament.admin.resources.settings.index')
                    ->url('http://127.0.0.1:8000/admin/customer-numerahas'),
            ])
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                \Hasnayeen\Themes\Http\Middleware\SetTheme::class
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                \TomatoPHP\FilamentPWA\FilamentPWAPlugin::make()
                ,
                \TomatoPHP\FilamentSettingsHub\FilamentSettingsHubPlugin::make()
                ,
                \Hasnayeen\Themes\ThemesPlugin::make(),
                ReportsPlugin::make(),
                OverlookPlugin::make()
                    ->sort(2)
                    ->columns([
                        'default' => 1,
                        'sm' => 2,
                        'md' => 3,
                        'lg' => 6,
                        'xl' => 5,
                        '2xl' => null,
                    ])
                    ->includes([
                        \App\Filament\Resources\CustomerNumerahaResource::class,
                        \App\Filament\Resources\CustomersResource::class,
                        \App\Filament\Resources\EmployeesResource::class,
                        \App\Filament\Resources\FinanceResource::class,
                    ])
                ,
                KnowledgeBasePlugin::make(),
            ])
            ->databaseNotifications()
            ->widgets([
                OverlookWidget::class,
            ])
            ->resources([
                config('filament-logger.activity_resource')
            ]);
        ;
        ;

    }
}
