<?php

namespace Nethead\Markup\Helpers;

/**
 * Trait CanBeReadonly
 * @package Nethead\Markup\Helpers
 */
trait CanBeReadonly {
    /**
     * @param $value
     * @return $this
     */
    public function readonly($value)
    {
        $this->attrs()->set('readonly', (bool) $value);
        return $this;
    }
}