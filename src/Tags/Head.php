<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Class Head
 * @package Nethead\Markup\Tags
 */
class Head extends Tag {
    /**
     * Head constructor.
     * @param array $attributes
     * @param array $contents
     */
    public function __construct(array $attributes = [], array $contents = [])
    {
        parent::__construct('head', $attributes, $contents);
    }
}