<?php

namespace Nethead\Markup\UrlGenerators;

/**
 * Interface UrlGenerator
 * @package Nethead\Markup
 */
interface UrlGenerator {
    /**
     * Generate a URL to static asset (JS/CSS/PDF/JPG/etc)
     * @param $path
     * @param null $secure
     * @return string
     */
    public function pathToAsset($path, $secure = null) : string;

    /**
     * Generate a general URL (external, internal, to anything)
     * @param $path
     * @param null $secure
     * @return string
     */
    public function generalUrl($path, $secure = null) : string;

    /**
     * Generate URL to a homepage (/)
     * @param null $secure
     * @return string
     */
    public function homepage($secure = null) : string;
}