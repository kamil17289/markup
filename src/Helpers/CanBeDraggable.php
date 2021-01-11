<?php

namespace Nethead\Markup\Helpers;

/**
 * Trait CanBeDraggable.
 * Add this trait to any custom Tag implementation to make it draggable.
 *
 * @package Nethead\Markup\Helpers
 */
trait CanBeDraggable {
    /**
     * Add or remove the draggable attribute on this element.
     *
     * @param mixed $value
     *  Adds draggable attribute if $value is truthy, removes it otherwise.
     * @return $this
     */
    public function draggable($value)
    {
        $this->attrs()->set('draggable', (bool) $value);
        return $this;
    }
}