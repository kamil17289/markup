<?php

namespace Nethead\Markup\Html;

/**
 * Class Select
 * @package Nethead\Markup\Html
 */
class Select extends Tag {
    /**
     * Select constructor.
     * @param array $options
     * @param array $attributes
     */
    public function __construct(array $options = [], array $attributes = [])
    {
        parent::__construct('select', $attributes, $options);
    }

    /**
     * @param bool $value
     * @return Select
     */
    public function autofocus(bool $value = true)
    {
        return $this->setBooleanAttribute('autofocus', $value);
    }

    /**
     * @param bool $value
     * @return Select
     */
    public function disabled(bool $value = true)
    {
        return $this->setBooleanAttribute('disabled', $value);
    }

    /**
     * @param bool $value
     * @return Select
     */
    public function required(bool $value)
    {
        return $this->setBooleanAttribute('required', $value);
    }

    /**
     * @param bool $value
     * @return Select
     */
    public function multiple(bool $value = true)
    {
        return $this->setBooleanAttribute('multiple', $value);
    }

    /**
     * @param string $value
     * @return Select
     */
    public function name(string $value)
    {
        $this->setHtmlAttribute('name', $value);
        return $this;
    }

    /**
     * @param int $value
     * @return Select
     */
    public function size(int $value)
    {
        $this->setHtmlAttribute('size', $value);
        return $this;
    }
}