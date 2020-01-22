<?php

namespace Nethead\Markup\Html;

/**
 * Class Label
 * @package Nethead\Markup\Html
 */
class Label extends Tag {
    /**
     * Label constructor.
     * @param string $for
     * @param string $text
     * @param string $form
     * @param array $attributes
     */
    public function __construct(string $for, string $text, array $attributes = [], string $form = '')
    {
        parent::__construct('label', $attributes, $text);

        $this->setHtmlAttribute('for', $for);

        if (! empty($form)) {
            $this->form($form);
        }
    }

    /**
     * @param string $value
     * @return $this
     */
    public function form(string $value)
    {
        $this->setHtmlAttribute('form', $value);
        return $this;
    }
}