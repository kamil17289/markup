<?php

namespace Nethead\Markup\Tags;

class Head extends Tag {
    public function __construct(array $attributes = [], $contents = '')
    {
        parent::__construct('head', $attributes, $contents);
    }
}