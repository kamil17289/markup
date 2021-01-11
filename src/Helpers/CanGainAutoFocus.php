<?php

namespace Nethead\Markup\Helpers;

/**
 * Trait CanGainAutoFocus.
 * Add this trait to any Tag implementation that can gain focus on load.
 *
 * @package Nethead\Markup\Helpers
 */
trait CanGainAutoFocus {
    /**
     * Set this element to gain focus automatically.
     *
     * @param mixed $value
     * @return $this
     */
    public function autofocus($value = true)
    {
        $this->attrs()->set('autofocus', (bool) $value);
        return $this;
    }
}