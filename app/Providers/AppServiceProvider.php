<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\DateTimeType;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Mendaftarkan tipe 'timestamp' di Doctrine DBAL sebagai 'DateTimeType'
        if (!Type::hasType('timestamp')) {
            Type::addType('timestamp', DateTimeType::class);
        }
    }
}
