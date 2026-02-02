<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class TrainerPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('trainer')
            ->path('trainer')
            ->brandName('Entrenadores Login') ///nombre
            ->login()  // <--- ¡ESTA LÍNEA FALTABA! Sin ella, no existe /trainer/login
            ->authGuard('trainer') // <--- Asegura que use la tabla 'trainers' y no 'users'
            ->colors([
                'primary' => \Filament\Support\Colors\Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Trainer/Resources'), for: 'App\\Filament\\Trainer\\Resources')
            ->discoverPages(in: app_path('Filament/Trainer/Pages'), for: 'App\\Filament\\Trainer\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Trainer/Widgets'), for: 'App\\Filament\\Trainer\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            
            // ESTA ES LA LÍNEA CORREGIDA:
            \Filament\Http\Middleware\DisableBladeIconComponents::class,
            
            \Filament\Http\Middleware\DispatchServingFilamentEvent::class,
        ])
            ->authMiddleware([
                \Filament\Http\Middleware\Authenticate::class,
            ]);
    }
}
