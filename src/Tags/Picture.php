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
     * @param string $href
     * @param array $attributes
     * @todo Image tag must be the last child of Picture
     * @return Picture
     */
    public function source(string $href, int $width = 320, bool $up = true, array $attributes = []): Picture
    {
        if (empty($this->children)) {
            $this->addChildren([
                new Image($href, $this->alt, $attributes)
            ]);
        }
        else {
            $this->addChildren([
                Source::make($attributes)
                    ->srcset($href)
                    ->media($width, $up)
            ]);
        }

       return $this;
    }
}