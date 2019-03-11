<?php

namespace Nethead\Markup\Html;

/**
 * Class Script
 * @package Nethead\Markup\Html
 */
class Script extends Tag {
    /**
     * Script constructor.
     * @param array $attributes
     * @param string $contents
     */
    public function __construct(array $attributes = [], $contents = '')
    {
        parent::__construct('script', $attributes, $contents);

        if (! empty($contents)) {
            $this->removeHtmlAttribute('src');
        }
    }

    /**
     * Set the inner HTML of tag
     * @param $contents
     * @return $this
     */
    public function setContents($contents) {
        parent::setContents($contents);

        if (! empty($this->contents)) {
            $this->removeHtmlAttribute(['src', 'async', 'defer']);
        }

        return $this;
    }

    /**
     * Helper for quickly adding async attribute
     * @return $this
     */
    public function async()
    {
        $this->setHtmlAttribute('async', true);

        $this->clearContents();

        return $this;
    }

    /**
     * Helper for quickly adding defer attribute
     * @return $this
     */
    public function defer()
    {
        $this->setHtmlAttribute('defer', true);

        $this->clearContents();

        return $this;
    }
}