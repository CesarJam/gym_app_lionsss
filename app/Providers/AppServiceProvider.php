<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Filament\Support\Facades\FilamentView;

class AppServiceProvider extends ServiceProvider
use Illuminate\Support\Facades\URL;
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    // Usamos una variable para obtener la URL correcta de tu imagen
    $imagenUrl = asset('images/fondo.jpg'); 

    FilamentView::registerRenderHook(
        'panels::auth.login.form.after',
        fn (): string => Blade::render(<<<HTML
            <style>
                body {
                    /* Aquí usamos la variable con la ruta real */
                    background-image: url('{$imagenUrl}'); 
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                    height: 100vh;
                }
                .fi-simple-main-ctn {
                    background-color: rgba(255, 255, 255, 0.33);
                    border-radius: 15px;
                }
            </style>
        HTML)
    );
}
}
