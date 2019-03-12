<?php

namespace Nethead\Markup\Html;

/**
 * Class Picture
 * @package Nethead\Markup\Html
 */
class Picture extends Tag {
    /**
     * Source sets for <picture>
     * @var array
     */
    public $srcset = [];

    /**
     * Picture constructor.
     * @param array $attributes
     * @param array $contents
     */
    public function __construct(array $attributes = [], $contents = [])
    {
        if (! is_array($contents) && ! empty($contents)) {
            $contents = [$contents];
        }

        parent::__construct('picture', $attributes, $contents);
    }

    /**
     * Add default <img> inside the <picture>
     * @param string $src
     * @param string $alt
     * @param array $attributes
     * @return $this
     */
    public function image(string $src, string $alt, array $attributes = [])
    {
        $this->contents[] = new Image($src, $alt, $attributes);

        return $this;
    }

    /**
     * Add <source> set to the <picture>
     * @param string $srcset
     * @param string $media
     * @returns $this
     */
    public function source(string $srcset, string $media, array $attributes = [])
    {
       $this->contents[] = new Source($srcset, $media, $attributes);

       return $this;
    }
}