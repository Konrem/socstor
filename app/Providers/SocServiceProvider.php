<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class SocServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->headerConfigs();
        $this->footerConfigs();
        $this->slider();
    }

    public function headerConfigs() {
        View::composer('layouts.header', function($view) {
            $view->with('config', \App\Config::find(1) );
        });
    }

    public function footerConfigs() {
        View::composer('layouts.footer', function($view) {
            $view->with('config', \App\Config::find(1) );
        });
    }

    public function slider() {
        View::composer('layouts.header', function($view) {
            $view->with('sliders', \App\Slider::where('type', 1)->get() );
        });
    }
}
