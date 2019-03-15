<?php

namespace Nethead\Markup;

use Nethead\Markup\Html\Stylesheet;
use Nethead\Markup\UrlGenerators\UrlGenerator;
use Nethead\Markup\Html\Picture;
use Nethead\Markup\Html\Mailto;
use Nethead\Markup\Html\Script;
use Nethead\Markup\Html\Image;
use Nethead\Markup\Html\Style;
use Nethead\Markup\Html\Link;
use Nethead\Markup\Html\Meta;
use Nethead\Markup\Html\Tag;
use Nethead\Markup\Html\A;

/**
 * Class MarkupBuilder
 * @package Nethead\Markup
 */
class MarkupBuilder {
    /**
     * \Nethead\Markup\UrlGenerators\UrlGenerator implementation
     * @var UrlGenerator
     */
    protected $urlGenerator;

    /**
     * MarkupBuilder constructor.
     * @param UrlGenerator $urlGenerator
     */
    public function __construct(UrlGenerator $urlGenerator = null)
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
            $attributes['src'] = $this->urlGenerator->pathToAsset($assetPath, $secure);
        }

        return new Script($attributes, $secure);
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
     * Render <link> to external CSS sheet
     * @param string $href
     * @param string $media
     * @param array $attributes
     * @return Link
     */
    public function stylesheet(string $href, string $media, array $attributes = [])
    {
        $attributes['rel'] = 'stylesheet';
        $attributes['media'] = $media;
        $attributes['href'] = $this->urlGenerator->pathToAsset($href);

        return new Link($attributes);
    }

    /**
     * Render alternative document versions in <link> element
     * @param string $href
     * @param string $type
     * @param string $title
     * @param array $attributes
     * @return Link
     */
    public function alternate(string $href, string $type, string $title = '', array $attributes = [])
    {
        $attributes = array_merge($attributes, [
            'href' => $this->urlGenerator->generalUrl($href),
            'type' => $type,
            'rel' => 'alternate'
        ]);

        if (! empty($title)) {
            $attributes['title'] = $title;
        }

        return new Link($attributes);
    }

    /**
     * Render <link> element to document's author
     * @param $href
     * @param array $attributes
     * @return Link
     */
    public function author(string $href, array $attributes = [])
    {
        $attributes = array_merge($attributes, [
            'rel' => 'author',
            'href' => $this->urlGenerator->generalUrl($href)
        ]);

        return new Link($attributes);
    }

    /**
     * Render the favicon <link> element
     * @param string $href
     * @param string $type
     * @param string $sizes
     * @param array $attributes
     * @return Link
     */
    public function icon(string $href, string $type, string $sizes, array $attributes = [])
    {
        $attributes = array_merge($attributes, [
            'href' => $this->urlGenerator->pathToAsset($href),
            'type' => $type,
            'sizes' => $sizes,
            'rel' => 'icon'
        ]);

        return new Link($attributes);
    }

    /**
     * Render <img> element
     * @param string $src
     * @param string $alt
     * @param array $attributes
     * @return Image
     */
    public function image(string $src, string $alt, array $attributes = [])
    {
        $src = $this->urlGenerator->pathToAsset($src);

        return new Image($src, $alt, $attributes);
    }

    /**
     * Render a <picture> element
     * @param array $attributes
     * @param array $contents
     * @return Picture
     */
    public function picture(array $attributes = [], $secure = null)
    {
        $homepage = $this->urlGenerator->homepage();

        return new Picture($attributes, $contents);
    }

    /**
     * Render <a> element
     * @param string $href
     * @param string $text
     * @param array $attributes
     * @return A
     */
    public function a(string $href, string $text, array $attributes = [])
    {
        return new A($href, $text, $attributes);
    }

    /**
     * Render obfuscated mailto: <a> element
     * @param string $email
     * @param string $text
     * @param array $attributes
     * @return Mailto
     */
    public function mailto(string $email, string $text, array $attributes = [])
    {
        return new Mailto($email, $text, $attributes);
    }

    /**
     * Render custom <meta> element
     * @param string $name
     * @param string $content
     * @return Meta
     */
    public function meta(string $name, string $content)
    {
        return new Meta($name, $content);
    }

    /**
     * Render charset <meta> element
     * @param string $charset
     * @return \Illuminate\Support\HtmlString
     */
    public function charset($charset = 'UTF-8')
    {
        return Meta::charset($charset);
    }

    /**
     * Render viewport <meta> element
     * @param string $content
     * @return Meta
     */
    public function viewport(string $content = 'width=device-width, initial-scale=1.0')
    {
        return $this->meta('viewport', $content);
    }

    /**
     * Render author <meta> element
     * @param string $content
     * @return Meta
     */
    public function meta_author(string $content)
    {
        return $this->meta('author', $content);
    }

    /**
     * Render description <meta> element
     * @param string $content
     * @return Meta
     */
    public function meta_description(string $content) {
        return $this->meta('description', $content);
    }

    /**
     * Render keywords <meta> element
     * @param string $content
     * @return Meta
     */
    public function meta_keywords(string $content)
    {
        return $this->meta('keywords', $content);
    }
}