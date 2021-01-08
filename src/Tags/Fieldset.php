<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Helpers\CanBeDisabled;

/**
 * Creates a "fieldset" element.
 *
 * @package Nethead\Markup\Tags
 */
class Fieldset extends Tag {
    use CanBeDisabled;

    /**
     * Fieldset constructor.
     *
     * @param array $children
     *  Child elements that will be put inside (images, texts, whatever)
     * @param array $attributes
     *  Additional HTML attributes you want to add
     */
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('fieldset', $attributes, $children);
    }
}