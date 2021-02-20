<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class NavServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mainMenu();
        $this->footerMenu();
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

    private function mainMenu(){
        view()->composer('frontend.partials.navbar','App\Http\Utilities\NavComposer@menu');
        // view()->composer('new.partials._nav','App\Http\Composers\FrontendComposer@whereWego');
    }     
    private function footerMenu(){
        view()->composer('frontend.partials.footer-2','App\Http\Utilities\NavComposer@footer');
    }         
}
