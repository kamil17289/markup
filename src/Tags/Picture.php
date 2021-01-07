<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Class Picture
 * @package Nethead\Markup\Html
 */
class Picture extends Tag {
    /**
     * @var string $alt
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
     * @return Picture
     */
    public function source(string $href, string $media = '', array $attributes = []): Picture
    {
        if (empty($this->children)) {
            $this->addChildren([
                new Image($href, $this->alt, $attributes)
            ]);
        }
        else {
            $this->addChildren([
                new Source($href, $media, $attributes)
            ]);
        }

       return $this;
    }
}