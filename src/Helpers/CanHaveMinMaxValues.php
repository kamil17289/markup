<?php

namespace Nethead\Markup\Helpers;

/**
 * Trait CanHaveMinMaxValues.
 * Add this trait to any implementation that can have min and max attributes.
 *
 * @package Nethead\Markup\Helpers
 */
trait CanHaveMinMaxValues {
    /**
     * Set the maximum value for this input.
     *
     * @param mixed $value
     * @return $this
     */
    public function max($value)
    {
        $this->attrs()->set('max', $value);
        return $this;
    }

    /**
     * Set the minimum value for this input.
     *
     * @param mixed $value
     * @return $this
     */
    public function min($value)
    {
        $this->attrs()->set('min', $value);
        return $this;
    }
}