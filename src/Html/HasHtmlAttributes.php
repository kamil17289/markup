<?php

namespace Nethead\Markup\Html;

/**
 * Trait HasHtmlAttributes
 * @package Nethead\Markup\Html
 */
trait HasHtmlAttributes {
    /**
     * @var array $htmlAttributes List of HTML element attributes in format:
     *  'htmlAttributeName' => 'AttributeValue'
     */
    public $htmlAttributes = [];

    /**
     * List of attributes which value shouldn't be escaped
     * @var array
     */
    protected $notEscapedAttributes = [];

    /**
     * Set HTML attributes. Every call of this will remove previously set attributes
     * @param array $attrs
     */
    public function setHtmlAttributes(array $attrs = [])
    {
        $defaults = method_exists($this, 'getDefaultAttributes') ? $this->getDefaultAttributes() : [];

        $this->htmlAttributes = array_merge($defaults, $attrs);
    }

    /**
     * Set one of the HTML attributes
     * @param string $name
     * @param $value
     */
    public function setHtmlAttribute(string $name, $value = null)
    {
        $this->htmlAttributes[$name] = $value;
    }

    /**
     * Merge new attributes into current list
     * @param array $newAttributes
     */
    public function mergeHtmlAttributes(array $newAttributes)
    {
        $this->htmlAttributes = array_merge($this->htmlAttributes, $newAttributes);
    }

    /**
     * If more convenient that public property, there is a helper function
     * for retrieving all HTML attributes
     * @return array
     */
    public function getHtmlAttributes() : array
    {
        return $this->htmlAttributes;
    }

    /**
     * Get value of one of the attributes
     * @param string $name
     * @param string $default
     * @return string
     */
    public function getHtmlAttribute(string $name, $default = '')
    {
        if (isset($this->htmlAttributes[$name])) {
            return $this->htmlAttributes[$name];
        }

        return $default;
    }

    /**
     * Remove the given attribute from list
     * @param $name
     */
    public function removeHtmlAttribute($name)
    {
        if (is_array($name)) {
            foreach($name as $attributeName) {
                $this->removeHtmlAttribute($attributeName);
            }
        }
        else {
            if (isset($this->htmlAttributes[$name])) {
                unset($this->htmlAttributes[$name]);
            }
        }
    }

    /**
     * Render the attributes as HTML string
     * @return string
     */
    public function renderHtmlAttributes() : string
    {
        if (empty($this->htmlAttributes))
            return '';

        $attributes = [];

        foreach($this->htmlAttributes as $attributeName => $value) {
            $attribute = $this->renderHtmlAttribute($attributeName, $value);

            if (! empty($attribute)) {
                $attributes[] = $attribute;
            }
        }

        return implode(' ', $attributes);
    }

    /**
     * Render single HTML attribute
     * @param string $name
     * @param $value
     * @return string
     */
    public function renderHtmlAttribute(string $name, $value) : string
    {
        $name = e($name);

        // no-value attributes, like required, disabled, readonly
        if (is_bool($value)) {
            return $value ? $name : '';
        }

        if (! is_null($value)) {
            if (! in_array($name, $this->notEscapedAttributes)) {
                $value = e($value);
            }

            return sprintf('%s="%s"', $name, $value);
        }

        return '';
    }
}