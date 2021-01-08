<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Foundation\TextNode;

/**
 * Creates a "legend" element.
 *
 * @package Nethead\Markup\Tags
 */
class Legend extends Tag {
    /**
     * Legend constructor.
     *
     * @param string $text
     *  Text that will be displayed in the legend
     * @param array $attributes
     *  Additional HTML attributes you want to add
     */
    public function __construct(string $text, array $attributes = [])
    {
        parent::__construct('legend', $attributes, [new TextNode($text)]);
    }
}