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

    /**
     * LaravelUrlAdapter constructor.
     * @param LaravelGenerator $generator\
     */
    public function __construct(LaravelGenerator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * @param $path
     * @param null $secure
     * @return string
     */
    public function pathToAsset($path, $secure = null) : string
    {
        return $this->generator->asset($path, $secure);
    }

    /**
     * @param $path
     * @param null $secure
     * @return string
     */
    public function generalUrl($path, $secure = null) : string
    {
        return $this->generator->to($path, [], $secure);
    }

    /**
     * @param null $secure
     * @return string
     */
    public function homepage($secure = null): string
    {
        return $this->generator->to('/');
    }
}