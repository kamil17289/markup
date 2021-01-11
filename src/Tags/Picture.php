<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Creates "picture" element.
 *
 * @package Nethead\Markup\Tags
 */
class Picture extends Tag {
    /**
     * @var string $alt
     */
    protected $alt;

    /**
     * Picture constructor.
     *
     * @param string $alt
     * @param array $attributes
     */
    public function __construct(string $alt, array $attributes = [])
    {
        $this->alt = $alt;

        parent::__construct('picture', $attributes, []);
    }

    /**
     * Add "source" element to the "picture"
     *
     * @param int $width
     *  Media breakpoint width in pixels
     * @param string $href
     *  URL of the image source
     * @param array $attributes
     *  Additional HTML attributes you'd like to add
     * @return Picture
     */
    public function source(string $href, int $width = 320, bool $up = true, array $attributes = []): Picture
    {
        $this->addChildren([
            Source::make($attributes)
                ->srcset($href)
                ->media($width, $up)
        ]);

       return $this;
    }

    /**
     * Add "image" tag to a picture structure.
     * Image tag must be the last child of the picture tag. All other sources have to be rendered above,
     * so use this method when adding the last image source.
     *
     * @param string $href
     *  The URL of the image
     * @param string $alt
     *  Alternative text to display if the image can't be loaded.
     * @param array $attributes
     *  Additional HTML attributes you'd like to add
     * @return Picture
     */
    public function image(string $href, string $alt, array $attributes = []): Picture
    {
        $this->addChildren([
            new Image($href, $alt, $attributes)
        ]);

        return $this;
    }
}