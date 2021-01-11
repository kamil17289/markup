<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Creates a "link" element.
 *
 * @package Nethead\Markup\Tags
 */
class Link extends Tag {
    /**
     * Link constructor.
     *
     * @param array $attributes
     *  Additional HTML attributes you want to add
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct('link', $attributes);
    }
}