<?php

namespace Nethead\Markup\Helpers;

/**
 * Trait CanBeReadonly.
 * Add this trait to any custom Tag implementation to make it readonly.
 *
 * @package Nethead\Markup\Helpers
 */
trait CanBeReadonly {
    /**
     * Add or remove the readonly attribute on this element.
     *
     * @param mixed $value
     *  Adds readonly attribute if $value is truthy, removes it otherwise.
     * @return $this
     */
    public function readonly($value)
    {
        $this->attrs()->set('readonly', (bool) $value);
        return $this;
    }
}