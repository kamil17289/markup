<?php

namespace Nethead\Markup\Html;

/**
 * Class Image
 * @package Nethead\Markup\Html
 */
class Image extends Tag {
    /**
     * Image constructor.
     * @param string $src
     * @param string $alt
     * @param array $attributes
     */
    public function __construct(string $src, string $alt = '', array $attributes = [])
    {
        $attributes['src'] = $src;
        $attributes['alt'] = $alt;

        parent::__construct('img', $attributes, '');
    }

    /**
     * Set the title for the image
     * @param string $text
     * @return $this
     */
    public function title(string $text)
    {
        $this->setHtmlAttribute('title', $text);

        return $this;
    }
}