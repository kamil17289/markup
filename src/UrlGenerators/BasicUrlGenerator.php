<?php

namespace Nethead\Markup\UrlGenerators;

/**
 * Class BasicUrlGenerator
 * @package Nethead\Markup\UrlGenerators
 */
class BasicUrlGenerator implements UrlGenerator {
    /**
     * @var string
     */
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = $_SERVER['HTTP_HOST'];
    }

    /**
     * @param $path
     * @param null $secure
     * @return string
     */
    public function pathToAsset($path, $secure = null) : string
    {
        return $this->generalUrl($path, $secure);
    }

    /**
     * @param $path
     * @param null $secure
     * @return string
     */
    public function generalUrl($path, $secure = null) : string
    {
        return ($secure ? 'https://' : 'http://') . $this->baseUrl . '/' . $path;
    }

    /**
     * @param null $secure
     * @return string
     */
    public function homepage($secure = null) : string
    {
        return $this->generalUrl('');
    }
}