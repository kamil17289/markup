<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Creates a "style" element.
 *
 * @package Nethead\Markup\Tags
 */
class Style extends Tag {
    /**
     * Style constructor.
     *
     * @param array $attributes
     *  Additional HTML attributes you want to add
     * @param array $contents
     */
    public function __construct(array $attributes = [], array $contents = [])
    {
        parent::__construct('style', $attributes, $contents);
    }

    /**
     * Provides default attributes for the HtmlAttributes object.
     *
     * @see \Nethead\Markup\Helpers\HtmlAttributes
     * @inheritdoc
     * @return array
     */
    public function getDefaultAttributes()
    {
        return [
            'type' => 'text/css',
            'media' => 'all'
        ];
    }

    /**
     * Set the devices for which this stylesheet should be used.
     *
     * @param string $value Devices list as for the media query standard
     * @return Style
     */
    public function media(string $value): Style
    {
        $this->attrs()->set('media', $value);

        return $this;
    }
}