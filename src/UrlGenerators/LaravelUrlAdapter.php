<?php

namespace Nethead\Markup\UrlGenerators;

use Illuminate\Contracts\Routing\UrlGenerator as LaravelGenerator;

/**
 * Class LaravelUrlAdapter
 * @package Nethead\Markup\UrlGenerators
 */
class LaravelUrlAdapter implements UrlGenerator {
    /**
     * Laravel's UrlGenerator implementation
     * @var LaravelGenerator
     */
    protected $generator;

    public function __construct(LaravelGenerator $generator)
    {
        $this->generator = $generator;
    }

    public function pathToAsset($path, $secure = null) : string
    {
        return $this->generator->asset($path, $secure);
    }

    public function generalUrl($path, $secure = null) : string
    {
        return $this->generator->to($path, [], $secure);
    }

    public function homepage($secure = null): string
    {
        return $this->generator->to('/');
    }
}