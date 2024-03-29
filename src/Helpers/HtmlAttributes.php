<?php

namespace Nethead\Markup\Helpers;

/**
 * Helper class for HTML attributes manipulation.
 * @package Nethead\Markup\Helpers
 */
class HtmlAttributes implements \JsonSerializable {
    /**
     * List of HTML element attributes
     * @var array $htmlAttributes
     */
    public $attrs = [];

    /**
     * ClassList object helper
     * @var ClassList
     */
    public $classList;

    /**
     * HtmlAttributes constructor.
     * @param array $attrs
     *  HTML attributes in format: 'htmlAttributeName' => 'attributeValue'
     * @param array $defaults
     *  Default attributes that can be used if no custom attributes are provided for the element.
     *  In same format as $attrs
     */
    public function __construct(array $attrs = [], array $defaults = [])
    {
        $this->classList = new ClassList();

        if (! empty($defaults)) {
            $attrs = array_merge($defaults, $attrs);
        }

        if (array_key_exists('class', $attrs)) {
            $this->classList->add($attrs['class']);
            unset($attrs['class']);
        }

        $this->setMany($attrs);
    }

    /**
     * Get the classList just like in Javascript.
     * @return ClassList
     */
    public function classList(): ClassList
    {
        return $this->classList;
    }

    /**
     * Set one of the HTML attributes.
     * No value escaping here as some of them can be boolean/null types.
     * You can also use this to remove the attribute by giving it false as the value.
     *
     * @param string $name
     *  Name of the attribute you want to set.
     * @param null $value
     *  Value of the attribute you want to set. Use null to remove the attribute.
     * @return HtmlAttributes
     */
    public function set(string $name, $value = null): HtmlAttributes
    {
        if (is_null($value)) {
            $this->remove($name);
        }
        elseif ($name == 'class') {
            $this->classList->add($value);
        }
        else {
            $this->attrs[$name] = $value;
        }

        return $this;
    }

    /**
     * Set many attributes in one call.
     * Attributes should be structured in the same format as in __construct.
     * If one or more attributes values are bool false, they will be removed from the list.
     *
     * @param array $attrs HTML attributes in format: 'htmlAttributeName' => 'attributeValue'
     * @return HtmlAttributes
     */
    public function setMany(array $attrs): HtmlAttributes
    {
        foreach($attrs as $name => $value) {
            $this->set($name, $value);
        }

        return $this;
    }

    /**
     * Get value of the attribute of given name.
     * Call without parameters to get all in array.
     *
     * @param string|null $name Name of the attribute you want to retrieve value of
     * @param string $default Default value that will be returned if the requested attribute doesn't exists
     * @return mixed|string Value of the requested attribute or $default if it doesn't exists
     */
    public function get(string $name = null, $default = '')
    {
        if (is_null($name)) {
            return $this->attrs;
        }

        if ($name == 'class') {
            return $this->classList->__toString();
        }

        if (isset($this->attrs[$name])) {
            return $this->attrs[$name];
        }

        return $default;
    }

    /**
     * @param string $attribute
     * @param $value
     * @return bool
     */
    public function is(string $attribute, $value): bool
    {
        return $this->get($attribute) === $value;
    }

    /**
     * Remove the given attribute(s) from list.
     *
     * @param array|string $name
     *  Name of the single attribute to remove, or an array containing the attributes names as values.
     * @return HtmlAttributes
     */
    public function remove($name): HtmlAttributes
    {
        if (is_array($name)) {
            foreach($name as $attrName) {
                $this->remove($attrName);
            }
        }
        elseif ($name == 'class') {
            $this->classList->remove($name);
        }
        else {
            unset($this->attrs[$name]);
        }

        return $this;
    }

    /**
     * Set the data-* attribute for the element.
     *
     * @param string $name
     *  Name of the data attribute, omit the "data-" as it will be added automatically.
     *  Example: ->data('open', 'modal');
     * @param mixed $value
     *  Value of the data attribute
     * @return HtmlAttributes
     */
    public function data(string $name, $value): HtmlAttributes
    {
        $this->set("data-$name", $value);
        return $this;
    }

    /**
     * Set the aria-* attribute for the element.
     *
     * @param string $name
     *  Name of the data attribute, omit the "aria-" as it will be added automatically.
     * @param mixed $value
     *  Value of the aria attribute
     * @return HtmlAttributes
     */
    public function aria(string $name, $value): HtmlAttributes
    {
        $this->set("aria-$name", $value);
        return $this;
    }

    /**
     * Set the event attribute for the element.
     *
     * @param string $action
     * @param $value
     * @return $this
     */
    public function on(string $action, $value): HtmlAttributes
    {
        $this->set('on' . $action, $value);
        return $this;
    }

    /**
     * Set the access key for the element.
     *
     * @param $key
     * @return $this
     */
    public function accessKey($key): HtmlAttributes
    {
        $this->set('accesskey', $key);
        return $this;
    }

    /**
     * Helper function for converting some of PHP types into string attributes values
     * @param $value
     * @return string
     */
    public function stringValue($value): string
    {
        $type = gettype($value);

        switch($type) {
            case 'boolean':
                if ($value) return '(true)';
                else return '(false)';

            case 'array':
                return implode('', $value);

            case 'object':
                if (method_exists($value, '__toString'))
                    return $value->__toString();
                else
                    return '(object)';

            case 'resource':
                return '(resource)';

            case 'NULL':
                return '(null)';

            case 'integer':
            case 'double':
            case 'string':
            default:
                return (string) $value;
        }
    }

    /**
     * Render the attributes as HTML string.
     * @return string
     */
    public function render(): string
    {
        $attributes = [];

        if (! empty($this->attrs)) {
            foreach($this->attrs as $attrName => $attrValue) {
                $attrName = htmlspecialchars($attrName, ENT_QUOTES);

                // no-value attributes, like required, disabled, readonly
                if (in_array($attrName, HtmlConfig::$booleanAttributes)) {
                    if ($attrValue === true) {
                        $attributes[] = $attrName;
                    }
                }
                else {
                    $attrValue = $this->stringValue($attrValue);

                    if (! in_array($attrName, HtmlConfig::$notEscapedAttributes)) {
                        $attrValue = htmlspecialchars($attrValue, ENT_QUOTES);
                    }

                    $attributes[] = sprintf('%s="%s"', $attrName, $attrValue);
                }
            }
        }

        if (! $this->classList->empty()) {
            $attributes[] = sprintf('%s="%s"', 'class', $this->classList->render());
        }

        return implode(' ', $attributes);
    }

    /**
     * Convert the HtmlAttributes object into HTML string.
     * @see HtmlAttributes::render()
     * @return string
     */
    public function __toString(): string
    {
        return $this->render();
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return array_merge($this->attrs, [
            'class' => $this->classList
        ]);
    }
}
