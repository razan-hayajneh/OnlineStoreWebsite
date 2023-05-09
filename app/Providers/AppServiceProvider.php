<?php

namespace App\Providers;

use Illuminate\Support\Facades\{App,Schema};
use Illuminate\Support\ServiceProvider;

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

        App::setLocale('en');
        Schema::defaultStringLength(191);
        date_default_timezone_set('Asia/Amman');
    }
}
