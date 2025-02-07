<?php

namespace App\Providers;

use App\Custom\CustomPaginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\LengthAwarePaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->alias(CustomPaginator::class, LengthAwarePaginator::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // if(config('app.env')==='local'){
        //     URL::forceScheme('https');
        // }
    }
}
