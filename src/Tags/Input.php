<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Helpers\CanBeDisabled;
use Nethead\Markup\Helpers\CanBeReadonly;
use Nethead\Markup\Helpers\CanBeRequired;

/**
 * Class Input
 * @package Nethead\Markup\Html
 */
class Input extends Tag {
    use CanBeDisabled, CanBeReadonly, CanBeRequired;

    /**
     * Input constructor.
     * @param string $type
     * @param string $name
     * @param string $value
     * @param array $attributes
     */
    public function __construct(string $type, string $name, $value = '', array $attributes = [])
    {
        parent::__construct('input', $attributes);

        $this->attrs()->setMany([
            'type' => $type,
            'value' => $value,
            'name' => $name
        ]);
    }

    /**
     * @param $value
     * @return Input
     */
    public function autocomplete($value = true): Input
    {
        $this->attrs()->set('autocomplete', $value);

        return $this;
    }

    /**
     * @param $value
     * @return Input
     */
    public function autofocus($value = true): Input
    {
        $this->attrs()->set('autofocus', $value);

        return $this;
    }

    /**
     * @param $value
     * @return Input
     */
    public function checked($value = true): Input
    {
        $selfType = $this->attrs()->get('type');

        if ($selfType == 'radio' || $selfType == 'checkbox') {
            $this->attrs()->set('checked', $value);
        }

        return $this;
    }

    /**
     * @param $value
     * @return Input
     */
    public function multiple($value = true): Input
    {
        $this->attrs()->set('multiple', $value);

        return $this;
    }

    /**
     * @param string $value
     * @return Input
     */
    public function max(string $value): Input
    {
        $this->attrs()->set('max', $value);
        return $this;
    }

    /**
     * @param string $value
     * @return Input
     */
    public function min(string $value): Input
    {
        $this->attrs()->set('min', $value);
        return $this;
    }

    /**
     * @param int $value
     * @return Input
     */
    public function maxlength(int $value): Input
    {
        $this->attrs()->set('maxlength', $value);
        return $this;
    }

    /**
     * @param string $value
     * @return Input
     */
    public function name(string $value): Input
    {
        $this->attrs()->set('name', $value);
        return $this;
    }

    /**
     * @param string $value
     * @return Input
     */
    public function pattern(string $value): Input
    {
        $this->attrs()->set('pattern', $value);
        return $this;
    }

    /**
     * @param string $value
     * @return Input
     */
    public function placeholder(string $value): Input
    {
        $this->attrs()->set('placeholder', $value);
        return $this;
    }

    /**
     * @param $value
     * @return Input
     */
    public function value($value): Input
    {
        $this->attrs()->set('value', $value);
        return $this;
    }

    /**
     * @param int $value
     * @return Input
     */
    public function step(int $value): Input
    {
        $this->attrs()->set('step', $value);
        return $this;
    }

    /**
     * @param string $id
     * @return Input
     */
    public function list(string $id): Input
    {
        $this->attrs()->set('list', $id);
        return $this;
    }
}