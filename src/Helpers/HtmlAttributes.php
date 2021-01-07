<?php

namespace Nethead\Markup\Helpers;

class HtmlAttributes {
    /**
     * @var array $htmlAttributes List of HTML element attributes in format:
     *  'htmlAttributeName' => 'AttributeValue'
     */
    public $attrs = [];

    /**
     * @var ClassList
     */
    public $classList;

    /**
     * HtmlAttributes constructor.
     * @param array $attrs
     * @param array $defaults
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
     * Get the classList just like in Javascript
     * @return ClassList
     */
    public function classList(): ClassList
    {
        return $this->classList;
    }

    /**
     * Set one of the HTML attributes
     * No value escaping here as some of them can be boolean/null types
     * You can also use this to remove the attribute by giving it false as the value
     * @param string $name
     * @param null $value
     * @return HtmlAttributes
     */
    public function set(string $name, $value = null): HtmlAttributes
    {
        if ($value === false) {
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
     * @param array $attrs
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
     * Get value of one of the attributes
     * Call without parameters to get all
     * @param string|null $name
     * @param string $default
     * @return mixed|string
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
     * Remove the given attribute from list
     * @param $name
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
     * Set the data-* attribute and value for the element
     * @param $name
     * @param $value
     */
    public function data($name, $value)
    {
        $this->set("data-$name", $value);
    }

    /**
     * Set the aria-* attribute and value for the element
     * @param $name
     * @param $value
     */
    public function aria($name, $value)
    {
        $this->set("aria-$name", $value);
    }

    /**
     * Render the attributes as HTML string
     * @return string
     */
    public function render(): string
    {
        $attributes = [];

        if (! empty($this->attrs)) {
            foreach($this->attrs as $attrName => $attrValue) {
                $attrName = htmlspecialchars($attrName, ENT_QUOTES);

                // no-value attributes, like required, disabled, readonly
                if (is_bool($attrValue)) {
                    $attributes[] = $attrValue ? $attrName : '';
                }
                elseif (! is_null($attrValue)) {
                    if (! in_array($attrName, HtmlConfig::$notEscapedAttributes)) {
                        $attrValue = htmlspecialchars($attrValue, ENT_QUOTES);
                    }

                    if (! empty($attrValue)) {
                        $attributes[] = sprintf('%s="%s"', $attrName, $attrValue);
                    }
                }
            }
        }

        if (! $this->classList->empty()) {
            $attributes[] = sprintf('%s="%s"', 'class', $this->classList->render());
        }

        return implode(' ', $attributes);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->render();
    }
}