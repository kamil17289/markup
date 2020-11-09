<?php

namespace Nethead\Markup\Tags;

/**
 * Class Legend
 * @package Nethead\Markup\Html
 */
class Legend extends Tag {
    /**
     * Legend constructor.
     * @param string $text
     * @param array $attributes
     */
    public function __construct(string $text, array $attributes = [])
    {
        parent::__construct('legend', $attributes, $text);
    }
}