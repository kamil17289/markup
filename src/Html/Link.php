<?php

namespace Nethead\Markup\Html;

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