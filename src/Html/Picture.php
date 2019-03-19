<?php

namespace Nethead\Markup\Html;

use Nethead\Markup\UrlGenerators\UrlGenerator;

/**
 * Class Picture
 * @package Nethead\Markup\Html
 */
class Picture extends Tag {
    /**
     * @var
     */
    protected $alt;

    /**
     * @var
     */
    protected $secure;

    /**
     * @var
     */
    protected $urlGenerator;

    /**
     * Picture constructor.
     * @param string $alt
     * @param array $attributes
     * @param UrlGenerator $urlGenerator
     * @param mixed $secure
     */
    public function __construct(string $alt, array $attributes = [], UrlGenerator $urlGenerator, $secure = null)
    {
        $this->urlGenerator = $urlGenerator;

        $this->alt = $alt;

        $this->secure = $secure;

        parent::__construct('picture', $attributes, []);
    }

    /**
     * Add <source> set to the <picture>
     * @param string $media
     * @param string $href
     * @param array $attributes
     * @returns $this
     */
    public function source(string $href, string $media = '', array $attributes = [])
    {
        if (empty($this->contents)) {
            $this->contents[] = new Image($this->urlGenerator->pathToAsset($href, $this->secure), $this->alt, $attributes);
        }
        else {
            $this->contents[] = new Source($this->urlGenerator->pathToAsset($href, $this->secure), $media, $attributes);
        }

       return $this;
    }
}