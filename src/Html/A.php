<?php

namespace Nethead\Markup\Html;

/**
 * Class A
 * @package Nethead\Markup\Html
 */
class A extends Tag {
    /**
     * A constructor.
     * @param string $href
     * @param string $contents
     * @param array $attributes
     */
    public function __construct(string $href, string $contents, array $attributes = [])
    {
        parent::__construct('a', $attributes, $contents);

        $this->setHtmlAttribute('href', $href);
    }

    /**
     * Helper function for indicating download link
     * @return $this
     */
    public function download()
    {
        $this->setHtmlAttribute('download', true);

        return $this;
    }

    /**
     * Helper function for setting target frame
     * @param string $targetWindow
     * @return $this
     */
    public function target(string $targetWindow)
    {
        $this->setHtmlAttribute('target', $targetWindow);

        return $this;
    }

    /**
     * Helper function to quickly set target as new window
     * @return $this
     */
    public function blank()
    {
        $this->setHtmlAttribute('target', '_blank');

        return $this;
    }

    /**
     * @param string $relation
     */
    public function rel(string $relation)
    {
        $this->setHtmlAttribute('rel', $relation);
    }
}