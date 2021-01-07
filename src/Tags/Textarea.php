<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Helpers\CanBeDisabled;
use Nethead\Markup\Helpers\CanBeReadonly;
use Nethead\Markup\Helpers\CanBeRequired;

/**
 * Class Textarea
 * @package Nethead\Markup\Html
 */
class Textarea extends Tag {
    use CanBeDisabled, CanBeReadonly, CanBeRequired;

    /**
     * Textarea constructor.
     * @param string $name
     * @param array $attributes
     * @param array $contents
     */
    public function __construct(string $name, array $attributes = [], array $contents = [])
    {
        parent::__construct('textarea', $attributes, $contents);

        $this->attrs()->set('name', $name);
    }

    /**
     * @param int $value
     * @return Textarea
     */
    public function cols(int $value): Textarea
    {
        $this->attrs()->set('cols', $value);
        return $this;
    }

    /**
     * @param int $value
     * @return Textarea
     */
    public function rows(int $value): Textarea
    {
        $this->attrs()->set('rows', $value);
        return $this;
    }

    /**
     * @param bool $value
     * @return Textarea
     */
    public function autocomplete(bool $value = true): Textarea
    {
        $this->attrs()->set('autocomplete', $value);
        return $this;
    }

    /**
     * @param bool $value
     * @return Textarea
     */
    public function autofocus(bool $value = true): Textarea
    {
        $this->attrs()->set('autofocus', $value);
        return $this;
    }

    /**
     * @param int $value
     * @return Textarea
     */
    public function maxlength(int $value): Textarea
    {
        $this->attrs()->set('maxlength', $value);
        return $this;
    }

    /**
     * @param string $value
     * @return Textarea
     */
    public function placeholder(string $value): Textarea
    {
        $this->attrs()->set('placeholder', $value);
        return $this;
    }

    /**
     * @param string $value
     * @return Textarea
     */
    public function required(string $value): Textarea
    {
        $this->attrs()->set('required', $value);
        return $this;
    }
}