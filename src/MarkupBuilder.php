<?php

namespace Nethead\Markup;

use Illuminate\Contracts\Routing\UrlGenerator;
use Nethead\Markup\Html\Link;
use Nethead\Markup\Html\Script;
use Nethead\Markup\Html\Style;
use Nethead\Markup\Html\Tag;

/**
 * Class MarkupBuilder
 * @package Nethead\Markup
 */
class MarkupBuilder {
    /**
     * @var UrlGenerator
     */
    protected $urlGenerator;

    /**
     * MarkupBuilder constructor.
     * @param UrlGenerator $urlGenerator
     */
    public function __construct(UrlGenerator $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * Render a tag, whatever you like
     * @param string $name
     * @param array $attributes
     * @param string $contents
     * @return Tag
     */
    public function tag(string $name, array $attributes = [], $contents = '')
    {
        return new Tag($name, $attributes, $contents);
    }

    /**
     * Render <script>
     * @param string $assetPath
     * @param array $attributes
     * @param null $secure
     * @return Tag
     */
    public function script(string $assetPath = '', array $attributes = [], $secure = null)
    {
        if (! empty($assetPath)) {
            $attributes['src'] = $this->urlGenerator->asset($assetPath, $secure);
        }

        return new Script($attributes);
    }

    /**
     * Render <style>
     * @param array $attributes
     * @param string $contents
     * @return Style
     */
    public function style(array $attributes = [], $contents = '')
    {
        return new Style($attributes, $contents);
    }

    /**
     * Render <link> element
     * @param array $attributes
     * @return Link
     */
    public function link(array $attributes = [])
    {
        return new Link($attributes);
    }

    /**
     * TODO: image, a, ol, ul, meta, p
     */
}