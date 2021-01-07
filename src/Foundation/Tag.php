<?php

namespace Nethead\Markup\Foundation;

use Nethead\Markup\Helpers\ClassList;
use Nethead\Markup\Helpers\HtmlConfig;
use Nethead\Markup\Helpers\HtmlAttributes;

/**
 * Class Tag
 * @package Nethead\Markup\Html
 */
class Tag {
    /**
     * Tag name (a, title, meta, etc)
     * @var string $name Name of the tag
     */
    public $name;

    /**
     * Children of this tag
     * @var array $children Array containing the children of the tag - other tags
     */
    public $children = [];

    /**
     * @var HtmlAttributes
     */
    public $attrs;

    /**
     * Tag constructor.
     * @param $name
     * @param array $attributes
     * @param array $children
     */
    public function __construct(string $name, array $attributes = [], array $children = [])
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('Tag name cannot be empty!');
        }

        $this->name = $name;
        $this->children = $children;

        $defaults = method_exists($this, 'getDefaultAttributes') ? $this->getDefaultAttributes() : [];
        $this->attrs = new HtmlAttributes($attributes, $defaults);
    }

    /**
     * Set tag's inner HTML
     * @param array $children
     * @return mixed
     */
    public function setChildren(array $children) {
        if (! $this->isVoidElement()) {
            $this->children = $children;
        }

        return $this;
    }

    /**
     * Clear tag's inner HTML
     */
    public function clearChildren()
    {
        $this->children = [];
    }

    /**
     * Get the child element of a given key
     * @param string $key
     * @return Tag|TextNode|null
     */
    public function getChild(string $key)
    {
        if (array_key_exists($key, $this->children)) {
            return $this->children[$key];
        }

        return null;
    }

    /**
     * Remove child element
     * @param string $key
     */
    public function removeChild(string $key)
    {
        unset($this->children[$key]);
    }

    /**
     * Add new child elements
     * Warning: if some keys already exists they will be overwritten
     * @param array $children
     */
    public function addChildren(array $children)
    {
        $this->children = array_merge($this->children, $children);
    }

    /**
     * Modify the attributes
     * @return HtmlAttributes
     */
    public function attrs(): HtmlAttributes
    {
        return $this->attrs;
    }

    /**
     * Modify the class attribute directly
     * @return ClassList
     */
    public function classList(): ClassList
    {
        return $this->attrs->classList;
    }

    /**
     * @param callable $processor
     * @return Tag
     */
    public function with(callable $processor): Tag
    {
        $processor($this);

        return $this;
    }

    /**
     * Render the tag
     * @return string
     */
    public function __toString() : string
    {
        return $this->open() . $this->renderChildren() . $this->close();
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return $this->__toString();
    }

    /**
     * Check if this tag has it's closing equivalent
     * @return bool
     */
    public function isVoidElement() : bool
    {
        return in_array($this->name, HtmlConfig::$voidElements);
    }

    /**
     * @return string
     */
    public function open() : string
    {
        $tagOpening = '<' . htmlspecialchars($this->name, ENT_QUOTES, 'UTF-8', true);

        $attributes = $this->attrs()->render();

        if (! empty($attributes)) {
            $tagOpening .= ' ' . $attributes;
        }

        if ($this->isVoidElement() && (bool) HtmlConfig::$closeVoids) {
            $tagOpening .= '/>';

            return $tagOpening;
        }

        return $tagOpening . '>';
    }

    /**
     * @return string
     */
    public function renderChildren() : string
    {
        if ($this->isVoidElement() || empty($this->children)) {
            return '';
        }

        return implode('', $this->children);
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

    /**
     * Intercept any calls to undefined methods and use it for convenient attributes setting
     * Only global attributes can be set this way.
     * @param $name
     * @param $arguments
     */
    public function __call($name, $arguments)
    {
        if (in_array($name, HtmlConfig::$globalAttributes)) {
            $this->attrs()->set($name, $arguments[0]);
        }
    }
}