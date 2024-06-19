<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Payments\{BoletoPayment,CartaoCreditoPayment,PixPayment};


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('BoletoPayment', function() {
            return new BoletoPayment();
        });

        $this->app->bind('CartaoCreditoPayment', function() {
            return new CartaoCreditoPayment();
        });

        $this->app->bind('PixPayment', function() {
            return new PixPayment();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
