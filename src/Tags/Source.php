<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Class Source
 * @package Nethead\Markup\Html
 */
class Source extends Tag {
    /**
     * Source constructor.
     * @param string $srcset
     * @param string $media
     * @param array $attributes
     */
    public function __construct(string $srcset, string $media, array $attributes = [])
    {
        $attributes['srcset'] = $srcset;
        $attributes['media'] = $media;

        parent::__construct('source', $attributes);
    }
}