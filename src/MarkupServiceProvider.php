<?php

namespace Nethead\Markup;

use Illuminate\Support\ServiceProvider;

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
            return new MarkupBuilder($app['url']);
        });
    }
}