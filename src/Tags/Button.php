<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Helpers\BindableToForm;
use Nethead\Markup\Helpers\CanBeDisabled;

/**
 * Creates a "button" element.
 *
 * @package Nethead\Markup\Tags
 */
class Button extends Tag {
    use BindableToForm, CanBeDisabled;

    const TYPE_BUTTON = 'button';
    const TYPE_SUBMIT = 'submit';
    const TYPE_RESET = 'reset';

    /**
     * Button constructor.
     *
     * @param string $value
     *  Shortcut to set the value attribute directly.
     * @param string $type
     *  Type of the button. Can be 'button'|'submit'|'reset'.
     * @param array $children
     *  Child elements that will be put inside (images, texts, whatever)
     * @param array $attributes
     *  Additional HTML attributes you want to add
     */
    public function __construct(string $type = 'button', string $value = '', array $attributes = [], array $children = [])
    {
        parent::__construct('button', $attributes, $children);

        $this->attrs()->set('type', $type);

        if (! empty($value)) {
            $this->attrs()->set('value', $value);
        }
    }

    /**
     * Set the name for the button.
     *
     * @param string $name The given name will be used in HTML attribute 'name'.
     * @return Button
     */
    public function name(string $name): Button
    {
        $this->attrs()->set('name', $name);

        return $this;
    }
}