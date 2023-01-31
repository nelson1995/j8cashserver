<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;
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
        $this->app->bind(Client::class,function (){
            return new Client([
                'base_uri'=>'https://api.flutterwave.com/v3/',
                'headers'=> [
                    'Accept'=>'application/json',
                    'Authorization'=>'Bearer '.config('services.ravepay.secret_key')]
            ]);
        });

//        $this->app->bind(Client::class,function (){
//            return new Client([
//                'base_uri'=>'https://api.maxicashapp.com/',
//                'headers'=> ['Accept'=>'application/json',]
//            ]);
//        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
