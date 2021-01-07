<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Helpers\CanBeDisabled;

class Fieldset extends Tag {
    use CanBeDisabled;

    /**
     * Fieldset constructor.
     * @param array $attributes
     * @param array $contents
     */
    public function __construct(array $attributes = [], array $contents = [])
    {
        parent::__construct('fieldset', $attributes, $contents);
    }
}