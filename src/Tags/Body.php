<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Class Body
 * @package Nethead\Markup\Tags
 */
class Body extends Tag {
    /**
     * Body constructor.
     * @param array $attributes
     * @param array $contents
     */
    public function __construct(array $attributes = [], array $contents = [])
    {
        parent::__construct('body', $attributes, $contents);
    }
}