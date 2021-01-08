<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Creates "a" element.
 *
 * @see https://www.w3schools.com/tags/tag_a.asp
 * @package Nethead\Markup\Tags
 */
class A extends Tag {
    /**
     * A constructor.
     *
     * @param string $href
     *  The URL you want to link to
     * @param array $children
     *  Child elements that will be put inside the link (images, texts, whatever)
     * @param array $attributes
     *  Additional HTML attributes you want to add
     */
    public function __construct(string $href, array $children, array $attributes = [])
    {
        parent::__construct('a', $attributes, $children);

        $this->attrs()->set('href', $href);
    }

    /**
     * Helper function for indicating download link.
     *
     * @return A
     */
    public function download(): A
    {
        $this->attrs()->set('download', true);

        return $this;
    }

    /**
     * Helper function for setting target frame
     *
     * @param string $targetWindow Target window name
     * @return A
     */
    public function target(string $targetWindow): A
    {
        $this->attrs()->set('target', $targetWindow);

        return $this;
    }

    /**
     * Helper function to set the link to open in new tab.
     *
     * @return A
     */
    public function blank(): A
    {
        $this->attrs()->set('target', '_blank');

        return $this;
    }

    /**
     * Set the relation of the link.
     *
     * @param string $relation
     */
    public function rel(string $relation)
    {
        $this->attrs()->set('rel', $relation);
    }
}