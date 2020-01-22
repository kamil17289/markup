<?php

namespace Nethead\Markup\Html;

class Fieldset extends Tag {
    /**
     * Fieldset constructor.
     * @param array $attributes
     * @param string $contents
     */
    public function __construct(array $attributes = [], $contents = '')
    {
        parent::__construct('fieldset', $attributes, $contents);
    }

    /**
     * @param bool $value
     * @return Fieldset
     */
    public function disabled(bool $value = true)
    {
        return $this->setBooleanAttribute('disabled', $value);
    }
}