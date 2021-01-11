<?php

namespace Nethead\Markup\Helpers;

/**
 * Trait CanBeRequired.
 * Add this trait to any custom Tag implementation to make it required.
 *
 * @package Nethead\Markup\Helpers
 */
trait CanBeRequired {
    /**
     * Add or remove the required attribute on this element.
     *
     * @param mixed $value
     *  Adds required attribute if $value is truthy, removes it otherwise.
     * @return $this
     */
    public function required($value)
    {
        $this->attrs()->set('required', (bool) $value);
        return $this;
    }
}