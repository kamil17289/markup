<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Helpers\CanBeAutoCompleted;
use Nethead\Markup\Helpers\CanBeDisabled;
use Nethead\Markup\Helpers\CanBeReadonly;
use Nethead\Markup\Helpers\CanBeRequired;

/**
 * Creates "textarea" element.
 *
 * @package Nethead\Markup\Tags
 */
class Textarea extends Tag {
    use CanBeDisabled, CanBeReadonly, CanBeRequired, CanBeAutoCompleted;

    /**
     * Textarea constructor.
     *
     * @param string $name
     *  Data field name
     * @param array $children
     *  Child elements that will be put inside (images, texts, whatever)
     * @param array $attributes
     *  Additional HTML attributes you want to add
     */
    public function __construct(string $name, array $attributes = [], array $children = [])
    {
        parent::__construct('textarea', $attributes, $children);

        $this->attrs()->set('name', $name);
    }

    /**
     * Set the columns number for the textarea.
     *
     * @param int $value
     * @return Textarea
     */
    public function cols(int $value): Textarea
    {
        $this->attrs()->set('cols', $value);
        return $this;
    }

    /**
     * Set the rows number for the textarea.
     *
     * @param int $value
     * @return Textarea
     */
    public function rows(int $value): Textarea
    {
        $this->attrs()->set('rows', $value);
        return $this;
    }

    /**
     * Set the maximum length for this textarea field.
     *
     * @param int $value Number of characters allowed to put inside the textarea
     * @return Textarea
     */
    public function maxlength(int $value): Textarea
    {
        $this->attrs()->set('maxlength', $value);
        return $this;
    }

    /**
     * Set the placeholder for the textarea.
     *
     * @param string $value
     * @return Textarea
     */
    public function placeholder(string $value): Textarea
    {
        $this->attrs()->set('placeholder', $value);
        return $this;
    }
}