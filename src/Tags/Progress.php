<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Foundation\TextNode;

/**
 * Class Progress creates a progress indicators.
 * Use it to represent a task completion progress.
 *
 * @package Nethead\Markup\Tags
 */
class Progress extends Tag {
    /**
     * Progress constructor.
     *
     * @param string $label
     * @param int $value
     * @param int $max
     * @param array $attributes
     */
    public function __construct(string $label, $value = 0, $max = 100, array $attributes = [])
    {
        $attributes['value'] = $value;
        $attributes['max'] = $max;

        parent::__construct('progress', $attributes, [new TextNode($label)]);
    }
}