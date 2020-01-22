<?php

namespace Nethead\Markup\Html;

/**
 * Class Textarea
 * @package Nethead\Markup\Html
 */
class Textarea extends Tag {
    /**
     * Textarea constructor.
     * @param string $name
     * @param array $attributes
     * @param string $contents
     */
    public function __construct(string $name, array $attributes = [], string $contents = '')
    {
        parent::__construct('textarea', $attributes, $contents);

        $this->setHtmlAttribute('name', $name);
    }

    /**
     * @param int $value
     * @return $this
     */
    public function cols(int $value)
    {
        $this->setHtmlAttribute('cols', $value);
        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function rows(int $value)
    {
        $this->setHtmlAttribute('rows', $value);
        return $this;
    }

    /**
     * @param bool $value
     * @return Textarea
     */
    public function autocomplete(bool $value = true)
    {
        return $this->setBooleanAttribute('autocomplete', $value);
    }

    /**
     * @param bool $value
     * @return Textarea
     */
    public function autofocus(bool $value = true)
    {
        return $this->setBooleanAttribute('autofocus', $value);
    }

    /**
     * @param bool $value
     * @return Textarea
     */
    public function disabled(bool $value = true)
    {
        return $this->setBooleanAttribute('disabled', $value);
    }

    /**
     * @param int $value
     * @return $this
     */
    public function maxlength(int $value)
    {
        $this->setHtmlAttribute('maxlength', $value);
        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function placeholder(string $value)
    {
        $this->setHtmlAttribute('placeholder', $value);
        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function readonly(string $value)
    {
        $this->setHtmlAttribute('readonly', $value);
        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function required(string $value)
    {
        $this->setHtmlAttribute('required', $value);
        return $this;
    }
}