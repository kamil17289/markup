<?php

namespace Nethead\Markup\Html;

/**
 * Class Input
 * @package Nethead\Markup\Html
 */
class Input extends Tag {
    /**
     * Input constructor.
     * @param string $type
     * @param string $name
     * @param string $value
     * @param array $attributes
     * @param string $contents
     */
    public function __construct(string $type, string $name, $value = '', array $attributes = [])
    {
        parent::__construct('input', $attributes);

        $this->mergeHtmlAttributes([
            'type' => $type,
            'value' => $value,
            'name' => $name
        ]);
    }

    /**
     * @param bool $value
     * @return Input
     */
    public function autocomplete(bool $value = true)
    {
        return $this->setBooleanAttribute('autocomplete', $value);
    }

    /**
     * @param bool $value
     * @return Input
     */
    public function autofocus(bool $value = true)
    {
        return $this->setBooleanAttribute('autofocus', $value);
    }

    /**
     * @param bool $value
     * @return $this|Input
     */
    public function checked(bool $value = true)
    {
        if ($this->getHtmlAttribute('type') === 'radio' || $this->getHtmlAttribute('type') === 'checkbox') {
            return $this->setBooleanAttribute('checked', $value);
        }

        return $this;
    }

    /**
     * @param bool $value
     * @return Input
     */
    public function disabled(bool $value = true)
    {
        return $this->setBooleanAttribute('disabled', $value);
    }

    /**
     * @param bool $value
     * @return Input
     */
    public function multiple(bool $value = true)
    {
        return $this->setBooleanAttribute('multiple', $value);
    }

    /**
     * @param string $value
     * @return $this
     */
    public function max(string $value)
    {
        $this->setHtmlAttribute('max', $value);
        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function min(string $value)
    {
        $this->setHtmlAttribute('min', $value);
        return $this;
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
    public function name(string $value)
    {
        $this->setHtmlAttribute('name', $value);
        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function pattern(string $value)
    {
        $this->setHtmlAttribute('pattern', $value);
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
     * @param bool $value
     * @return Input
     */
    public function readonly(bool $value)
    {
        return $this->setBooleanAttribute('readonly', $value);
    }

    /**
     * @param bool $value
     * @return Input
     */
    public function required(bool $value)
    {
        return $this->setBooleanAttribute('required', $value);
    }

    /**
     * @param $value
     * @return $this
     */
    public function value($value)
    {
        $this->setHtmlAttribute('value', $value);
        return $this;
    }

    /**
     * @param int $value
     */
    public function step(int $value)
    {
        $this->setHtmlAttribute('step', $value);
    }

    /**
     * @param string $id
     */
    public function list(string $id)
    {
        $this->setHtmlAttribute('list', $id);
    }
}