<?php

namespace Nethead\Markup\Html;

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
     * Picture constructor.
     * @param string $alt
     * @param array $attributes
     */
    public function __construct(string $alt, array $attributes = [])
    {
        $this->alt = $alt;

        parent::__construct('picture', $attributes, []);
    }

    /**
     * Add <source> set to the <picture>
     * @param string $media
     * @param string $href
     * @param array $attributes
     * @return $this
     */
    public function source(string $href, string $media = '', array $attributes = [])
    {
        if (empty($this->contents)) {
            $this->contents[] = new Image($href, $this->alt, $attributes);
        }
        else {
            $this->contents[] = new Source($href, $media, $attributes);
        }

       return $this;
    }
}