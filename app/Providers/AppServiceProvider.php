<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        \Illuminate\Database\Connection::resolverFor('mysql', function ($pdo, $database, $prefix, $config) {
            return new \App\Database\LegacyMySqlConnection($pdo, $database, $prefix, $config);
        });
    }
}
