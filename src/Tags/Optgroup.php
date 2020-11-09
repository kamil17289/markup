<?php

namespace Nethead\Markup\Tags;

/**
 * Class Optgroup
 * @package Nethead\Markup\Html
 */
class Optgroup extends Tag {
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
     * @param bool $value
     * @return Optgroup
     */
    public function disabled(bool $value = true)
    {
        return $this->setBooleanAttribute('disabled', $value);
    }

    /**
     * @param string $value
     */
    public function label(string $value)
    {
        $this->setHtmlAttribute('label', $value);
    }
}