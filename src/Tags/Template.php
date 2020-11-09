<?php

namespace Nethead\Markup\Tags;

/**
 * Class Template
 * @package Nethead\Markup\Html
 */
class Template extends Tag {
    /**
     * Template constructor.
     * @param string $id
     * @param array $attributes
     * @param string $contents
     */
    public function __construct(string $id, array $attributes = [], $contents = '')
    {
        parent::__construct('template', $attributes, $contents);

        $this->setHtmlAttribute('id', $id);
    }
}