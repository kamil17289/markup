<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Helpers\BindableToForm;

/**
 * Creates "label" element.
 *
 * @package Nethead\Markup\Tags
 */
class Label extends Tag {
    use BindableToForm;

    /**
     * Label constructor.
     *
     * @param string $for
     *  HTML ID of the input that will be bind with this label
     * @param string $text
     *  Text for the label
     * @param array $attributes
     *  Additional HTML attributes you want to add
     */
    public function __construct(string $for, string $text, array $attributes = [])
    {
        parent::__construct('label', $attributes, $text);

        $this->attrs()->set('for', $for);
    }
}