<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Create "img" element.
 *
 * @package Nethead\Markup\Tags
 */
class Image extends Tag {
    /**
     * Image constructor.
     *
     * @param string $src
     *  URL for the image
     * @param string $alt
     *  Alternative text for the image
     * @param array $attributes
     *  Additional HTML attributes you want to add
     */
    public function __construct(string $src, string $alt = '', array $attributes = [])
    {
        $attributes['src'] = $src;
        $attributes['alt'] = $alt;

        parent::__construct('img', $attributes);
    }

    /**
     * Set the title for the image.
     *
     * @param string $text Text which will be put in "title" attribute
     * @return Image
     */
    public function title(string $text): Image
    {
        $this->attrs()->set('title', $text);

        return $this;
    }
}