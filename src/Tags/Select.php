<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Helpers\CanBeDisabled;
use Nethead\Markup\Helpers\CanBeReadonly;
use Nethead\Markup\Helpers\CanBeRequired;

/**
 * Class Select
 * @package Nethead\Markup\Html
 */
class Select extends Tag {
    use CanBeDisabled, CanBeReadonly, CanBeRequired;

    /**
     * Select constructor.
     * @param string $name
     * @param array $options
     * @param array $attributes
     */
    public function __construct(string $name, array $options = [], array $attributes = [])
    {
        parent::__construct('select', $attributes, $options);

        $this->attrs()->set('name', $name);
    }

    /**
     * @param $value
     * @return Select
     */
    public function autofocus($value = true): Select
    {
        $this->attrs()->set('autofocus', (bool) $value);
        return $this;
    }

    /**
     * @param $value
     * @return Select
     */
    public function required($value): Select
    {
        $this->attrs()->set('required', (bool) $value);
        return $this;
    }

    /**
     * @param $value
     * @return Select
     */
    public function multiple($value = true): Select
    {
        $this->attrs()->set('multiple', (bool) $value);
        return $this;
    }

    /**
     * @param string $value
     * @return Select
     */
    public function name(string $value): Select
    {
        $this->attrs()->set('name', $value);
        return $this;
    }

    /**
     * @param int $value
     * @return Select
     */
    public function size(int $value): Select
    {
        $this->attrs()->set('size', $value);
        return $this;
    }
}