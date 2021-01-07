<?php

namespace Nethead\Markup\Helpers;

/**
 * Trait CanBeDisabled
 * @package Nethead\Markup\Helpers
 */
trait CanBeDisabled {
    /**
     * @param $value
     * @return $this
     */
    public function disabled($value = true)
    {
        $this->attrs()->set('disabled', (bool) $value);

        return $this;
    }
}