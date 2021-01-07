<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Class A
 * @package Nethead\Markup\Html
 */
class A extends Tag {
    /**
     * A constructor.
     * @param string $href
     * @param array $children
     * @param array $attributes
     */
    public function __construct(string $href, array $children, array $attributes = [])
    {
        parent::__construct('a', $attributes, $children);

        $this->attrs()->set('href', $href);
    }

    /**
     * Helper function for indicating download link
     * @return $this
     */
    public function download()
    {
        $this->attrs()->set('download', true);

        return $this;
    }

    /**
     * Helper function for setting target frame
     * @param string $targetWindow
     * @return $this
     */
    public function target(string $targetWindow)
    {
        $this->attrs()->set('target', $targetWindow);

        return $this;
    }

    /**
     * Helper function to quickly set target as new window
     * @return $this
     */
    public function blank()
    {
        $this->attrs()->set('target', '_blank');

        return $this;
    }

    /**
     * @param string $relation
     */
    public function rel(string $relation)
    {
        $this->attrs()->set('rel', $relation);
    }
}