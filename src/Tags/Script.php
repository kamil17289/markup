<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Class Script
 * @package Nethead\Markup\Tags
 */
class Script extends Tag {
    /**
     * Script constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct('script', $attributes);
    }

    /**
     * Helper for quickly adding async attribute
     * @return Script
     */
    public function async(): Script
    {
        $this->attrs()->set('async', true);
        return $this;
    }

    /**
     * Helper for quickly adding defer attribute
     * @return Script
     */
    public function defer(): Script
    {
        $this->attrs()->set('defer', true);
        return $this;
    }
}