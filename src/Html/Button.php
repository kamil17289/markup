<?php

namespace Nethead\Markup\Html;

/**
 * Class Button
 * @package Nethead\Markup\Html
 */
class Button extends Tag {
    const TYPE_BUTTON = 'button';
    const TYPE_SUBMIT = 'submit';
    const TYPE_RESET = 'reset';

    /**
     * Button constructor.
     * @param string $value
     * @param string $type
     * @param array $attributes
     * @param string $contents
     */
    public function __construct(string $type = 'button', string $value = '', array $attributes = [], $contents = '')
    {
        parent::__construct('button', $attributes, $contents);

        $this->setHtmlAttribute('type', $type);

        if (! empty($value)) {
            $this->setHtmlAttribute('value', $value);
        }
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function disabled(bool $value = true)
    {
        if ($value) {
            $this->setHtmlAttribute('disabled', true);
        }

        return $this;
    }

    /**
     * @param Form $form
     * @return $this
     */
    public function form(Form $form)
    {
        $formId = $form->getHtmlAttribute('id');

        if ($formId) {
            $this->setHtmlAttribute('form', $formId);
        }

        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function name(string $name)
    {
        $this->setHtmlAttribute('name', $name);

        return $this;
    }
}