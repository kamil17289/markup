<?php
namespace Nethead\Markup\Foundation;

use Nethead\Markup\Helpers\ClassList;
use Nethead\Markup\Helpers\HtmlConfig;
use Nethead\Markup\Helpers\HtmlAttributes;

/**
 * A class for creating any HTML tag element you would like.
 * @package Nethead\Markup\Foundation
 */
class Tag {
    /**
     * Name of the tag (in HTML).
     * It can be any of the valid HTML tags (a, title, meta, etc)
     *
     * @var string $name
     */
    public $name;

    /**
     * Children of this tag.
     * Array containing the children of the tag - other tags.
     * Can contain Tag objects, strings, or anything that can be converted to string.
     * Children array can be associative to make it easier to retrieve the child elements.
     *
     * @var array $children
     */
    public $children = [];

    /**
     * HTML attributes of this Tag
     *
     * @see Tag::attrs() To quickly get the attributes object
     * @see HtmlAttributes For attributes management methods
     * @var HtmlAttributes
     */
    public $attrs;

    /**
     * Tag constructor.
     *
     * @param string $name
     *  Name of the Tag to create
     * @param array $attributes
     *  Attributes in form of array where keys are the names of attributes and values are... values
     * @param array $children
     *  Children of the tag being created. If you are creating void tag, it will have no effect.
     *  You can also set children for the tag using the public setChildren method
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
     *
     * @param array $children Children of the tag in form of array, same as for the constructor
     * @return Tag
     */
    public function setChildren(array $children): Tag {
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
     *
     * @param string $key The key of the $children array to retrieve
     * @return Tag|TextNode|null Child tag requested or null if the child doesn't exist
     */
    public function getChild(string $key)
    {
        if (array_key_exists($key, $this->children)) {
            return $this->children[$key];
        }

        return null;
    }

    /**
     * Remove child element of a given key
     *
     * @param string $key Child tag name (key) in $children array
     */
    public function removeChild(string $key)
    {
        unset($this->children[$key]);
    }

    /**
     * Add new child elements
     * Warning: if some keys already exists they will be overwritten
     *
     * @param array $children New children to merge into inner HTML
     */
    public function addChildren(array $children)
    {
        $this->children = array_merge($this->children, $children);
    }

    /**
     * Retrieve the attributes object
     *
     * @see HtmlAttributes To check how to modify the attributes of the tag
     * @return HtmlAttributes
     */
    public function attrs(): HtmlAttributes
    {
        return $this->attrs;
    }

    /**
     * Modify the class attribute directly, without calling ->attrs()
     *
     * @see ClassList to find out how to modify class names of the tags
     * @return ClassList
     */
    public function classList(): ClassList
    {
        return $this->attrs->classList;
    }

    /**
     * Pass the Tag instance to any processing function for further modification.
     * Can be useful for any initialization purposes, or for the HTML altering inside the modular application.
     *
     * @param callable $processor Function which will process the Tag object
     * @return Tag
     */
    public function with(callable $processor): Tag
    {
        $processor($this);

        return $this;
    }

    /**
     * Magic method to make the Tag object convertible to string
     *
     * @see Tag::render()
     * @return string
     */
    public function __toString() : string
    {
        return $this->open() . $this->renderChildren() . $this->close();
    }

    /**
     * Render the tag object to string.
     *
     * @return string Tag object compiled to a string that can be outputted to the browser.
     */
    public function render(): string
    {
        return $this->__toString();
    }

    /**
     * Check if this tag has it's closing equivalent
     *
     * @return bool TRUE if the Tag is a void tag, FALSE otherwise
     */
    public function isVoidElement() : bool
    {
        return in_array($this->name, HtmlConfig::$voidElements);
    }

    /**
     * Open the Tag in HTML.
     * Prints the opening < with a tag name and the attributes if there are any.
     * If the tag is void tag, and HtmlConfig::$closeVoids is set to true, it will be automatically closed with />.
     *
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
     * Render child elements of this Tag.
     *
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
     * Close the tag.
     * Prints the closing tag in HTML. If the tag is void tag, empty string will be returned instead.
     *
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
     * Intercept any calls to undefined methods and use it for convenient attributes setting.
     * Only global attributes can be set this way.
     *
     * @see https://www.w3schools.com/tags/ref_standardattributes.asp For a list of Global HTML Attributes
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