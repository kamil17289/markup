<?php

namespace Nethead\Markup\Foundation;

use Nethead\Markup\Helpers\HtmlAttributes;

/**
 * Class Tag
 * @package Nethead\Markup\Html
 */
class Tag {
    use HtmlAttributes;

    /**
     * HTML 5.3 void elements
     * @var array
     */
    protected $voidElements= [
        'area',
        'base',
        'br',
        'col',
        'embed',
        'hr',
        'img',
        'input',
        'link',
        'meta',
        'param',
        'source',
        'track',
        'wbr'
    ];

    /**
     * @var bool
     */
    public static $closeVoids;

    /**
     * Tag name (a, title, meta, etc)
     * @var
     */
    public $name;

    /**
     * Children of this tag
     * @var
     */
    public $contents = [];

    /**
     * Tag constructor.
     * @param $name
     * @param array $attributes
     * @param array $contents
     */
    public function __construct(string $name, array $attributes = [], array $contents = [])
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('Tag name cannot be empty!');
        }

        $this->name = $name;
        $this->contents = $contents;

        $this->setHtmlAttributes($attributes);
    }

    /**
     * Set tag's inner HTML
     * @param array $contents
     * @return mixed
     */
    public function setContents(array $contents) {
        if (! $this->isVoidElement()) {
            $this->contents = $contents;
        }

        return $this;
    }

    /**
     * Clear tag's inner HTML
     */
    public function clearContents()
    {
        $this->contents = [];
    }

    /**
     * Render the tag
     * @return string
     */
    public function __toString() : string
    {
        return $this->open() . $this->renderContents() . $this->close();
    }

    /**
     * Check if this tag has it's closing equivalent
     * @return bool
     */
    public function isVoidElement() : bool
    {
        return in_array($this->name, $this->voidElements);
    }

    /**
     * @return string
     */
    public function open() : string
    {
        $tagOpening = '<' . htmlspecialchars($this->name, ENT_QUOTES, 'UTF-8', true);

        $attributes = $this->renderHtmlAttributes();

        if (! empty($attributes)) {
            $tagOpening .= ' ' . $attributes;
        }

        if ($this->isVoidElement() && (bool) self::$closeVoids) {
            $tagOpening .= '/>';

            return $tagOpening;
        }

        return $tagOpening . '>';
    }

    /**
     * @return string
     */
    public function renderContents() : string
    {
        if ($this->isVoidElement() || empty($this->contents)) {
            return '';
        }

        return implode('', $this->contents);
    }

    /**
     * Close the tag
     * @return string
     */
    public function close() : string
    {
        if ($this->isVoidElement()) {
            return '';
        }

        return '</' . $this->name . '>';
    }
}