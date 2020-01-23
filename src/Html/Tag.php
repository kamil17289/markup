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
        $string = '<' . e($this->name);

        $attributes = $this->renderHtmlAttributes();

        if (! empty($attributes)) {
            $string .= ' ' . $attributes;
        }

        $string .= '>';

        // ignore content and closing tag for void elements
        if (! in_array($this->name, $this->voidElements)) {
            $string .= is_array($this->contents) ? implode(PHP_EOL, $this->contents) : $this->contents;

            $string .= '</' . $this->name . '>';
        }

        return $string;
    }
}