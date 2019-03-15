<?php

namespace Nethead\Markup\Html;

use Nethead\Markup\MarkupBuilder;

/**
 * Class Script
 * @package Nethead\Markup\Html
 */
class Script extends Tag {
    /**
     * Script constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [], $secure = null)
    {
        parent::__construct('script', $attributes, '');
    }

    /**
     * Helper for quickly adding async attribute
     * @return $this
     */
    public function async()
    {
        $this->setHtmlAttribute('async', true);
        return $this;
    }

    /**
     * Helper for quickly adding defer attribute
     * @return $this
     */
    public function defer()
    {
        $this->setHtmlAttribute('defer', true);
        return $this;
    }
}