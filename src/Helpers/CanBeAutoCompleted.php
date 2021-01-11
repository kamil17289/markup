<?php

namespace Nethead\Markup\Helpers;

/**
 * Trait CanBeAutoCompleted.
 * Add this trait to any Tag implementation which supports autocomplete attribute.
 *
 * @package Nethead\Markup\Helpers
 */
trait CanBeAutoCompleted {
    /**
     * Set the autocomplete attribute.
     *
     * @param mixed $value
     *  Anything truthy will result in `autocomplete="on"`,
     *  falsy will set it to `autocomplete="off"`
     * @return $this
     */
    public function autocomplete($value = true)
    {
        $autocomplete = $value ? 'on' : 'off';

        $this->attrs()->set('autocomplete', $autocomplete);

        return $this;
    }
}