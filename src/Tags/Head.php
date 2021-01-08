<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Creates "head" element.
 *
 * @package Nethead\Markup\Tags
 */
class Head extends Tag {
    /**
     * Head constructor.
     *
     * @param array $children
     *  Child elements that will be put inside (images, texts, whatever)
     * @param array $attributes
     *  Additional HTML attributes you want to add
     */
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('head', $attributes, $children);
    }
}