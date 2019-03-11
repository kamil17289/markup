<?php

namespace Nethead\Markup\Html;

/**
 * Class Link
 * @package Nethead\Markup\Html
 */
class Link extends Tag {
    /**
     * Link constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct('link', $attributes);
    }

    /**
     * Helper method for fast linking the external CSS into document
     * @param string $href
     * @param string $media
     * @return $this
     */
    public function stylesheet(string $href, string $media = 'all')
    {
        $this->mergeHtmlAttributes([
            'href' => $href,
            'media' => $media,
            'rel' => 'stylesheet'
        ]);

        return $this;
    }

    /**
     * Helper method for fast adding alternative document versions
     * @param string $href
     * @param string $type
     * @param string $title
     */
    public function alternate(string $href, string $type, string $title = '')
    {
        $this->mergeHtmlAttributes([
            'href' => $href,
            'type' => $type,
            'rel' => 'alternate'
        ]);

        if (! empty($title)) {
            $this->setHtmlAttribute('title', $title);
        }
    }

    /**
     * Helper function for linking document with it's author
     * @param $href
     */
    public function author($href)
    {
        $this->mergeHtmlAttributes([
            'rel' => 'author',
            'href' => $href
        ]);
    }

    /**
     * Helper method for fast adding the favicon
     * @param string $href
     * @param string $type
     * @param string $sizes
     */
    public function icon(string $href, string $type, string $sizes)
    {
        $this->mergeHtmlAttributes([
            'href' => $href,
            'type' => $type,
            'sizes' => $sizes,
            'rel' => 'icon'
        ]);
    }
}