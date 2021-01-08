<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Helpers\CanBeDisabled;
use Nethead\Markup\Helpers\CanBeReadonly;
use Nethead\Markup\Helpers\CanBeRequired;

/**
 * Creates a "datalist" element.
 *
 * @package Nethead\Markup\Tags
 */
class Datalist extends Tag {
    use CanBeRequired, CanBeReadonly, CanBeDisabled;

    /**
     * Datalist constructor.
     *
     * @param string $id
     *  The HTML id of the datalist
     * @param array $attributes
     *  Additional HTML attributes you want to add
     * @param array $options
     *  Options for the datalist in format `'machine_name' => 'Human readable name'`
     */
    public function __construct(string $id, array $attributes = [], array $options = [])
    {
        parent::__construct('datalist', $attributes, $options);

        $this->attrs()->set('id', $id);
    }
}