<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use App\Models\Info;

class AppServiceProvider extends ServiceProvider
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
    public function boot()
    {
        // if ($this->app->environment('production')) {
        //     URL::forceScheme('https');
        // }
        $this->shareGlobalVariables();
    }

    private function shareGlobalVariables()
    {
        view()->share([
            'infos' => $this->getActiveInfos(),
        ]);
    }

    private function getActiveInfos()
    {
        return Info::first();
    }
}
