<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Helpers\BindableToForm;
use Nethead\Markup\Helpers\CanBeDisabled;

/**
 * Class Button
 * @package Nethead\Markup\Html
 */
class Button extends Tag {
    use BindableToForm, CanBeDisabled;

    const TYPE_BUTTON = 'button';
    const TYPE_SUBMIT = 'submit';
    const TYPE_RESET = 'reset';

    /**
     * Button constructor.
     * @param string $value
     * @param string $type
     * @param array $attributes
     * @param array $contents
     */
    public function __construct(string $type = 'button', string $value = '', array $attributes = [], array $contents = [])
    {
        parent::__construct('button', $attributes, $contents);

        $this->attrs()->set('type', $type);

        if (! empty($value)) {
            $this->attrs()->set('value', $value);
        }
    }

    /**
     * @param string $name
     * @return $this
     */
    public function name(string $name)
    {
        $this->attrs()->set('name', $name);

        return $this;
    }
}