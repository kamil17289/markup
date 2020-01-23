<?php

namespace Nethead\Markup\Html;

/**
 * Class Datalist
 * @package Nethead\Markup\Html
 */
class Datalist extends Tag {
    /**
     * Datalist constructor.
     * @param string $id
     * @param array $attributes
     * @param array $options
     */
    public function __construct(string $id, array $attributes = [], array $options = [])
    {
        parent::__construct('datalist', $attributes, $options);

        $this->setHtmlAttribute('id', $id);
    }
}