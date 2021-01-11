<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Creates a "template" element.
 *
 * @package Nethead\Markup\Tags
 */
class Template extends Tag {
    /**
     * Template constructor.
     *
     * @param string $id
     *  The template ID
     * @param array $children
     *  Child elements that will be put inside (images, texts, whatever)
     * @param array $attributes
     *  Additional HTML attributes you want to add
     */
    public function __construct(string $id, array $attributes = [], array $children = [])
    {
        parent::__construct('template', $attributes, $children);

        $this->attrs()->set('id', $id);
    }
}