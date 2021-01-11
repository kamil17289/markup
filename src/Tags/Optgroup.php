<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Helpers\CanBeDisabled;

/**
 * Creates "optgroup" element.
 *
 * @package Nethead\Markup\Tags
 */
class Optgroup extends Tag {
    use CanBeDisabled;

    /**
     * Optgroup constructor.
     *
     * @param string $label
     *  The options group label
     * @param array $attributes
     *  Additional HTML attributes you want to add
     * @param array $children
     *  Child elements that will be put inside (option)
     */
    public function __construct(string $label, array $attributes = [], array $children = [])
    {
        parent::__construct('optgroup', $attributes, $children);

        $this->label($label);
    }

    /**
     * Set the label for the optgroup.
     *
     * @param string $value The label you want, if you want to change it
     * @return Optgroup
     */
    public function label(string $value): Optgroup
    {
        $this->attrs()->set('label', $value);

        return $this;
    }
}