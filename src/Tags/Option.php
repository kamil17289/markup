<?php

namespace Nethead\Markup\Tags;

/**
 * Class Option
 * @package Nethead\Markup\Html
 */
class Option extends Tag {
    /**
     * Option constructor.
     * @param $value
     * @param string $text
     * @param array $attributes
     */
    public function __construct($value, string $text, array $attributes = [])
    {
        parent::__construct('option', $attributes, $text);

        $this->value($value);
    }

    /**
     * @param $value
     */
    public function value($value)
    {
        $this->setHtmlAttribute('value', $value);
    }

    /**
     * @param string $value
     */
    public function label(string $value)
    {
        $this->setHtmlAttribute('label', $value);
    }
}