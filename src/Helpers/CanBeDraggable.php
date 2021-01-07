<?php

namespace Nethead\Markup\Helpers;

/**
 * Trait CanBeDraggable
 * @package Nethead\Markup\Helpers
 */
trait CanBeDraggable {
    /**
     * @param $value
     * @return $this
     */
    public function draggable($value)
    {
        $this->attrs()->set('draggable', (bool) $value);
        return $this;
    }
}