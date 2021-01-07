<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Class Meta
 * @package Nethead\Markup\Html
 */
class Meta extends Tag {
    /**
     * Meta constructor.
     * @param string $name
     * @param string $content
     */
    public function __construct(string $name, string $content)
    {
        parent::__construct('meta', [
            'name' => $name,
            'content' => $content
        ]);
    }
}