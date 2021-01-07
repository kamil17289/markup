<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Helpers\CanBeDisabled;
use Nethead\Markup\Helpers\CanBeReadonly;
use Nethead\Markup\Helpers\CanBeRequired;

/**
 * Class Datalist
 * @package Nethead\Markup\Html
 */
class Datalist extends Tag {
    use CanBeRequired, CanBeReadonly, CanBeDisabled;

    /**
     * Datalist constructor.
     * @param string $id
     * @param array $attributes
     * @param array $options
     */
    public function __construct(string $id, array $attributes = [], array $options = [])
    {
        parent::__construct('datalist', $attributes, $options);

        $this->attrs()->set('id', $id);
    }
}