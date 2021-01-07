<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Foundation\TextNode;

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
        parent::__construct('option', $attributes, [new TextNode($text)]);

        $this->value($value);
    }

    /**
     * @param $value
     */
    public function value($value)
    {
        $this->attrs()->set('value', $value);
    }

    /**
     * @param string $value
     */
    public function label(string $value)
    {
        $this->attrs()->set('label', $value);
    }
}