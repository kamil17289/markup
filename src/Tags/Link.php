<?php

namespace Nethead\Markup\Tags;

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