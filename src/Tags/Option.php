<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Foundation\TextNode;

/**
 * Creates "option" element.
 *
 * @package Nethead\Markup\Tags
 */
class Option extends Tag {
    /**
     * Option constructor.
     *
     * @param mixed $value
     *  The machine readable value for this option
     * @param string $text
     *  The human readable label of this otion
     * @param array $attributes
     *  Additional HTML attributes you want to add
     */
    public function __construct($value, string $text, array $attributes = [])
    {
        parent::__construct('option', $attributes, [new TextNode($text)]);

        $this->value($value);
    }

    /**
     * Set the value for the option.
     *
     * @param mixed $value
     */
    public function value($value)
    {
        $this->attrs()->set('value', $value);
    }

    /**
     * Set the label for the option.
     *
     * @param string $value
     */
    public function label(string $value)
    {
        $this->attrs()->set('label', $value);
    }

    /**
     * Mark the option as selected.
     *
     * @param bool $selected
     * @return void
     */
    public function selected(bool $selected = true)
    {
        $this->attrs()->set('selected', true);
    }
}