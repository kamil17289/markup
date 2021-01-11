<?php

namespace Nethead\Markup\Helpers;

/**
 * Trait CanBeDisabled.
 * Add this trait to any custom Tag implementation to make it possible to disable it by adding
 * HTML 'disabled' attribute in a boolean style (without value).
 * @package Nethead\Markup\Helpers
 */
trait CanBeDisabled {
    /**
     * Disable or enable the element.
     *
     * @param mixed $value
     *  Any value that can be casted to boolean. If truthy is provided, disabled attribute will
     *  be added. If falsy, it will be removed (the element will be enabled).
     * @return $this
     */
    public function disabled($value = true)
    {
        $this->attrs()->set('disabled', (bool) $value);

        return $this;
    }
}