<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Class Source
 * @package Nethead\Markup\Tags
 */
class Source extends Tag {
    /**
     * Source constructor.
     *
     * @param array $attributes
     *  Additional HTML attributes you want to add
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct('source', $attributes);
    }

    /**
     * Simple static factory method.
     *
     * @param array $attributes
     *  Additional HTML attributes you want to add
     * @return Source
     */
    public static function make(array $attributes = []): Source
    {
        return new self($attributes);
    }

    /**
     * Set the srcset attriute when using inside the "picture" tag
     *
     * @param string $srcset
     *  URL for your picture asset
     * @return $this
     */
    public function srcset(string $srcset): Source
    {
        $this->attrs()->set('srcset', $srcset);
        return $this;
    }

    /**
     * Set media query for this asset source.
     *
     * @param int $width
     *  Screen width in pixels
     * @param bool $up
     *  if TRUE, the min-width (breakpoint up) will be used, max-width otherwise (breakpoint down)
     * @return $this
     */
    public function media(int $width, bool $up = true): Source
    {
        $media = $up ? sprintf('(min-width:%spx)', $width) : sprintf('(max-width:%spx)', $width);

        $this->attrs()->set('media', $media);

        return $this;
    }

    /**
     * Set the video/audio source when using in "video" and "audio" tags.
     *
     * @param string $source
     * @return $this
     */
    public function src(string $source): Source
    {
        $this->attrs()->set('src', $source);
        return $this;
    }

    /**
     * Set the MIME type of the media source.
     *
     * @param string $type
     * @return $this
     */
    public function type(string $type): Source
    {
        $this->attrs()->set('type', $type);
        return $this;
    }
}