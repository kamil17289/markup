<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Creates a "body" element.
 *
 * @package Nethead\Markup\Tags
 */
class Body extends Tag {
    /**
     * Body constructor.
     *
     * @param array $children
     *  Child elements that will be put inside (images, texts, whatever)
     * @param array $attributes
     *  Additional HTML attributes you want to add
     */
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('body', $attributes, $children);
    }
}