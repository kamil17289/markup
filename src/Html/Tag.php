<?php

namespace Nethead\Markup\Html;

use Nethead\Markup\Commons\HasHtmlAttributes;

/**
 * Class Tag
 * @package Nethead\Markup\Html
 */
class Tag {
    use HasHtmlAttributes;

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
     * Tag name (a, title, meta, etc)
     * @var
     */
    public $name;

    /**
     * Children of this tag
     * @var
     */
    public $contents;

    /**
     * Tag constructor.
     * @param $name
     * @param array $attributes
     * @param string $contents
     */
    public function __construct(string $name, array $attributes = [], $contents = '')
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
     * @param $contents
     * @return $this
     */
    public function setContents($contents) {
        if (! in_array($this->name, $this->voidElements)) {
            $this->contents = $contents;
        }

        return $this;
    }

    /**
     * Clear tag's inner HTML
     */
    public function clearContents()
    {
        $this->contents = '';
    }

    /**
     * Render the tag
     */
    public function __toString()
    {
        return $this->open() . $this->renderContents() . $this->close();
    }

    /**
     * @param bool $closeVoids
     * @return string
     */
    public function open($closeVoids = false)
    {
        $tagOpening = '<' . htmlspecialchars($this->name, ENT_QUOTES, 'UTF-8', true);

        $attributes = $this->renderHtmlAttributes();

        if (! empty($attributes)) {
            $tagOpening .= ' ' . $attributes;
        }

        if ($closeVoids && in_array($this->name, $this->voidElements)) {
            $tagOpening .= '/>';

            return $tagOpening;
        }

        return $tagOpening . '>';
    }

    /**
     * @return string
     */
    public function renderContents()
    {
        if (in_array($this->name, $this->voidElements) || empty($this->contents)) {
            return '';
        }

        return is_array($this->contents) ? implode(PHP_EOL, $this->contents) : $this->contents;
    }

    /**
     * Close the tag
     * @return string
     */
    public function close()
    {
        if (in_array($this->name, $this->voidElements)) {
            return '';
        }

        return '</' . $this->name . '>';
    }
}