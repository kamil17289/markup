<?php

namespace Nethead\Markup\Helpers;

/**
 * Trait CanBeRequired
 * @package Nethead\Markup\Helpers
 */
trait CanBeRequired {
    /**
     * @param $value
     * @return $this
     */
    public function required($value)
    {
        $this->attrs()->set('required', (bool) $value);
        return $this;
    }
}