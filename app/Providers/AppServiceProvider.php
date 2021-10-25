<?php

namespace App\Providers;

use App\Http\Resources\TariffResource;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Sanctum::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        TariffResource::withoutWrapping();

//        DB::listen(function($sql) {
//            Log::info($sql->sql);
//            Log::info($sql->bindings);
//            Log::info($sql->time);
//        });
    }
}
