<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Creates "meta" element.
 *
 * @package Nethead\Markup\Tag
 */
class Meta extends Tag {
    /**
     * Meta constructor.
     *
     * @param string $name
     *  Meta element name
     * @param string $content
     *  Meta element value
     */
    public function __construct(string $name, string $content)
    {
        parent::__construct('meta', [
            'name' => $name,
            'content' => $content
        ]);
    }
}