<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Helpers\BindableToForm;

/**
 * Class Label
 * @package Nethead\Markup\Html
 */
class Label extends Tag {
    use BindableToForm;

    /**
     * Label constructor.
     * @param string $for
     * @param string $text
     * @param array $attributes
     */
    public function __construct(string $for, string $text, array $attributes = [])
    {
        parent::__construct('label', $attributes, $text);

        $this->attrs()->set('for', $for);
    }
}