<?php

namespace App\Providers;

use App\Charts\TeacherProfitChart;
use Illuminate\Support\ServiceProvider;
use ConsoleTVs\Charts\Registrar as Charts;


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
    public function boot(Charts $charts)
    {
        //
        // $this->app['router']->aliasMiddleware('noDebugbar', App\Http\Middleware\NoDebugbar::class);
        $charts->register([
            TeacherProfitChart::class,
        ]);
    }
}
