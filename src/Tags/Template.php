<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Class Template
 * @package Nethead\Markup\Html
 */
class Template extends Tag {
    /**
     * Template constructor.
     * @param string $id
     * @param array $attributes
     * @param array $contents
     */
    public function __construct(string $id, array $attributes = [], array $contents = [])
    {
        parent::__construct('template', $attributes, $contents);

        $this->attrs()->set('id', $id);
    }
}