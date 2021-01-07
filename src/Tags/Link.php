<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Class Link
 * @package Nethead\Markup\Html
 */
class Link extends Tag {
    /**
     * Link constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct('link', $attributes);
    }
}