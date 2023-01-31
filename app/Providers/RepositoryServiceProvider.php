<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Interfaces\TransferInterface','App\Repositories\TransferRepository');
        $this->app->bind('App\Repositories\Interfaces\DepositInterface','App\Repositories\DepositRepository');
        $this->app->bind('App\Repositories\Interfaces\WithDrawInterface','App\Repositories\WithDrawRepository');
        $this->app->bind('App\Repositories\Interfaces\AirtimeInterface','App\Repositories\AirtimeRepository');
        $this->app->bind('App\Repositories\Interfaces\ExchangeRateInterface','App\Repositories\ExchangeRateRepository');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
