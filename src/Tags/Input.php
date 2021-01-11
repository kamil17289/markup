<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Helpers\CanBeAutoCompleted;
use Nethead\Markup\Helpers\CanBeDisabled;
use Nethead\Markup\Helpers\CanBeReadonly;
use Nethead\Markup\Helpers\CanBeRequired;
use Nethead\Markup\Helpers\CanGainAutoFocus;
use Nethead\Markup\Helpers\CanHaveMinMaxValues;

/**
 * Creates an "input" element.
 *
 * @package Nethead\Markup\Tags
 */
class Input extends Tag {
    use CanBeDisabled,
    CanBeReadonly,
    CanBeRequired,
    CanBeAutoCompleted,
    CanGainAutoFocus,
    CanHaveMinMaxValues;

    /**
     * Input constructor.
     *
     * @param string $type
     *  Input type. Anything supported by the HTML input element: button, checkbox, password, text, etc
     * @param string $name
     *  Name of the input. *Important:* this is also the data name when the form is submitted
     * @param string $value
     *  Value for the input if it can be set
     * @param array $attributes
     *  Additional HTML attributes you want to add
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
     * Set/Unset this input as checked.
     * Invoking this method on inputs other than radio or checkbox will have no effect.
     *
     * @param mixed $value
     *  Truthy values will add a 'checked' attribute to this element.
     *  Falsy values will remove the attribute it if exists.
     * @return Input
     */
    public function checked($value = true): Input
    {
        $selfType = $this->attrs()->get('type');

        if ($selfType == 'radio' || $selfType == 'checkbox') {
            $this->attrs()->set('checked', (bool) $value);
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