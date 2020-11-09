<?php

namespace Nethead\Markup\Helpers;

/**
 * Trait HasHtmlAttributes
 * @package Nethead\Markup\Html
 */
trait HtmlAttributes {
    /**
     * Global attributes supported by every HTML tag
     * @var array
     */
    public $globalAttributes = [
        'accesskey',
        'class',
        'contenteditable',
        'dir',
        'draggable',
        'dropzone',
        'hidden',
        'id',
        'lang',
        'spellcheck',
        'style',
        'tabindex',
        'title',
        'translate'
    ];

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
     * Set HTML attributes.
     * This will never remove any of the existing attributes, but can overwrite their values
     * @param array $attrs
     */
    public function setHtmlAttributes(array $attrs = [])
    {
        if (! empty($this->htmlAttributes)) {
            $this->htmlAttributes = array_merge($this->htmlAttributes, $attrs);
        }
        else {
            $defaults = method_exists($this, 'getDefaultAttributes') ? $this->getDefaultAttributes() : [];
            $this->htmlAttributes = array_merge($defaults, $attrs);
        }
    }

    /**
     * Set HTML attributes
     * Every call of this method will remove all attributes set dynamically before this call
     * @param array $attrs
     */
    public function refreshAttributes(array $attrs = [])
    {
        $defaults = method_exists($this, 'getDefaultAttributes') ? $this->getDefaultAttributes() : [];

        $this->htmlAttributes = array_merge($defaults, $attrs);
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
     * Append the attribute value
     * @param string $name Attribute name which value will be appended
     * @param mixed $value The value which will be appended to the attribute
     * @param string $glue Character that will be used to separate (or not) the values
     */
    public function appendToAttribute(string $name, $value, $glue = ' ')
    {
        if (array_key_exists($name, $this->htmlAttributes)) {
            $this->htmlAttributes[$name] .= $glue . $value;
        }
        else {
            $this->htmlAttributes[$name] = $value;
        }
    }

    /**
     * If more convenient that public property, there is a helper function for retrieving all HTML attributes
     * @return array
     */
    public function getHtmlAttributes() : array
    {
        return $this->htmlAttributes;
    }

    /**
     * Set one of the HTML attributes
     * No value escaping here as some of them can be boolean/null types
     * @param string $name
     * @param $value
     */
    public function setHtmlAttribute(string $name, $value = null)
    {
        $this->htmlAttributes[$name] = $value;
    }

    /**
     * Get value of one of the attributes
     * @param string $name
     * @param string $default
     * @return string
     */
    public function getHtmlAttribute(string $name, $default = '') : string
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
     * @param string $name
     * @param bool $value
     * @return $this
     */
    protected function setBooleanAttribute(string $name, bool $value)
    {
        if ($value) {
            $this->setHtmlAttribute($name, true);
        }
        else {
            $this->removeHtmlAttribute($name);
        }

        return $this;
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
        $name = htmlspecialchars($name, ENT_QUOTES);

        // no-value attributes, like required, disabled, readonly
        if (is_bool($value)) {
            return $value ? $name : '';
        }

        if (! is_null($value)) {
            if (! in_array($name, $this->notEscapedAttributes)) {
                $value = htmlspecialchars($value, ENT_QUOTES);
            }

            return sprintf('%s="%s"', $name, $value);
        }

        return '';
    }

    /**
     * Set the data-* attribute and value for the element
     * @param $name
     * @param $value
     */
    public function data($name, $value)
    {
        $this->setHtmlAttribute("data-$name", $value);
    }

    /**
     * Set the aria-* attribute and value for the element
     * @param $name
     * @param $value
     */
    public function aria($name, $value)
    {
        $this->setHtmlAttribute("aria-$name", $value);
    }

    /**
     * Intercept any calls to undefined methods and use it for convenient attributes setting
     * Only global attributes can be set this way.
     * @param $name
     * @param $arguments
     */
    public function __call($name, $arguments)
    {
        if (in_array($name, $this->globalAttributes)) {
            $this->setHtmlAttribute($name, $arguments[0]);
        }
    }
}