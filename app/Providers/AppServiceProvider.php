<?php

namespace App\Providers;

use Braintree\Gateway;
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
        // iniettare un servizio in tutta la mia applicazione ed averlo disponibile ovunque
        // utilizzo il singleton (design pattern creazionale) che serve a creare una singola istanza e cosi sarà presente in tutta l'app

         $this->app->singleton(Gateway::class, function($app){
             return new Gateway(
                 [
                    'environment' => 'sandbox',
                    'merchantId' => '6kkmvpfqh8n88bbj',
                    'publicKey' => 'bnct3wd7sk8scnsv',
                    'privateKey' => '35c10fb92992c1374aa6e6aa95e86c7f'
                ]
            );
         });
    }
}
