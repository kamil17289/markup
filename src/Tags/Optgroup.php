<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Helpers\CanBeDisabled;

/**
 * Class Optgroup
 * @package Nethead\Markup\Html
 */
class Optgroup extends Tag {
    use CanBeDisabled;

    /**
     * Optgroup constructor.
     * @param string $label
     * @param array $attributes
     * @param array $contents
     */
    public function __construct(string $label, array $attributes = [], array $contents = [])
    {
        parent::__construct('optgroup', $attributes, $contents);

        $this->label($label);
    }

    /**
     * @param string $value
     * @return Optgroup
     */
    public function label(string $value): Optgroup
    {
        $this->attrs()->set('label', $value);

        return $this;
    }
}