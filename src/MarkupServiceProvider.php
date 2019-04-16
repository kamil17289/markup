<?php

namespace Nethead\Markup;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Nethead\Markup\Presenters\LaravelBladePresenter;

/**
 * Class MarkupServiceProvider
 * @package Nethead\Markup
 */
class MarkupServiceProvider extends ServiceProvider {
    /**
     * Boot the provider
     */
    public function boot()
    {
        //
    }

    /**
     * Register the main markup builder
     */
    public function register()
    {
        $this->app->singleton('markup', function ($app) {
            $laravelUrlAdapter = new UrlGenerators\LaravelUrlAdapter($app['url']);
            $presenter = new LaravelBladePresenter();

            return new MarkupBuilder($laravelUrlAdapter, $presenter);
        });
    }
}