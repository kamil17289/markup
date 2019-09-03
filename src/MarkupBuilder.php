<?php

namespace Nethead\Markup;

use Nethead\Markup\Presenters\PresenterInterface;
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
     * \Nethead\Markup\Presenters\PresenterInterface
     * @var
     */
    protected $presenter;

    /**
     * MarkupBuilder constructor.
     * @param UrlGenerator $urlGenerator
     * @param PresenterInterface $presenter
     */
    public function __construct(UrlGenerator $urlGenerator, PresenterInterface $presenter)
    {
        $this->urlGenerator = $urlGenerator;

        $this->presenter = $presenter;
    }

    /**
     * @param Tag $tag
     * @return mixed
     */
    protected function present(Tag $tag)
    {
        return $this->presenter->present($tag);
    }

    /**
     * Get HTML5 doctype declaration (only version 5 is supported)
     * @return string
     */
    public function doctype()
    {
        return '<!DOCTYPE html>';
    }

    /**
     * Render a tag, whatever you like
     * @param string $name
     * @param array $attributes
     * @param string $contents
     * @return mixed
     */
    public function tag(string $name, array $attributes = [], $contents = '')
    {
        return $this->present(new Tag($name, $attributes, $contents));
    }

    /**
     * Render <script>
     * @param string $assetPath
     * @param array $attributes
     * @param null $secure
     * @return mixed
     */
    public function script(string $assetPath = '', array $attributes = [], $secure = null)
    {
        if (! empty($assetPath)) {
            $attributes['src'] = $this->urlGenerator->pathToAsset($assetPath, $secure);
        }

        return $this->present(new Script($attributes, $secure));
    }

    /**
     * Render <style>
     * @param array $attributes
     * @param string $contents
     * @return mixed
     */
    public function style(array $attributes = [], $contents = '')
    {
        return $this->present(new Style($attributes, $contents));
    }

    /**
     * Render <link> element
     * @param array $attributes
     * @return mixed
     */
    public function link(array $attributes = [])
    {
        return $this->present(new Link($attributes));
    }

    /**
     * Render <link> to external CSS sheet
     * @param string $href
     * @param string $media
     * @param array $attributes
     * @return mixed
     */
    public function stylesheet(string $href, string $media, array $attributes = [])
    {
        $attributes['rel'] = 'stylesheet';
        $attributes['media'] = $media;
        $attributes['href'] = $this->urlGenerator->pathToAsset($href);

        return $this->present(new Link($attributes));
    }

    /**
     * Render alternative document versions in <link> element
     * @param string $href
     * @param string $type
     * @param string $title
     * @param array $attributes
     * @return mixed
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

        return $this->present(new Link($attributes));
    }

    /**
     * Render <link> element to document's author
     * @param $href
     * @param array $attributes
     * @return mixed
     */
    public function author(string $href, array $attributes = [])
    {
        $attributes = array_merge($attributes, [
            'rel' => 'author',
            'href' => $this->urlGenerator->generalUrl($href)
        ]);

        return $this->present(new Link($attributes));
    }

    /**
     * Render the favicon <link> element
     * @param string $href
     * @param string $type
     * @param string $sizes
     * @param array $attributes
     * @return mixed
     */
    public function icon(string $href, string $type, string $sizes, array $attributes = [])
    {
        $attributes = array_merge($attributes, [
            'href' => $this->urlGenerator->pathToAsset($href),
            'type' => $type,
            'sizes' => $sizes,
            'rel' => 'icon'
        ]);

        return $this->present(new Link($attributes));
    }

    /**
     * Render <img> element
     * @param string $src
     * @param string $alt
     * @param array $attributes
     * @return mixed
     */
    public function image(string $src, string $alt, array $attributes = [])
    {
        $src = $this->urlGenerator->pathToAsset($src);

        return $this->present(new Image($src, $alt, $attributes));
    }

    /**
     * Render a <picture> element
     * @param string $alt
     * @param array $attributes
     * @param mixed $secure
     * @return mixed
     */
    public function picture(string $alt, array $attributes = [], $secure = null)
    {
        return $this->present(new Picture($alt, $attributes, $this->urlGenerator, $secure));
    }

    /**
     * Render <a> element
     * @param string $href
     * @param string $text
     * @param array $attributes
     * @return mixed
     */
    public function a(string $href, string $text, array $attributes = [])
    {
        return $this->present(new A($href, $text, $attributes));
    }

    /**
     * Render obfuscated mailto: <a> element
     * @param string $email
     * @param string $text
     * @param array $attributes
     * @return mixed
     */
    public function mailto(string $email, string $text, array $attributes = [])
    {
        return $this->present(new Mailto($email, $text, $attributes));
    }

    /**
     * Render custom <meta> element
     * @param string $name
     * @param string $content
     * @return mixed
     */
    public function meta(string $name, string $content)
    {
        return $this->present(new Meta($name, $content));
    }

    /**
     * Render charset <meta> element
     * @param string $charset
     * @return string
     */
    public function charset($charset = 'UTF-8')
    {
        return Meta::charset($charset);
    }

    /**
     * Render viewport <meta> element
     * @param string $content
     * @return mixed
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