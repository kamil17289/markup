<?php

namespace Nethead\Markup\Tags;

class Body extends Tag {
    public function __construct(array $attributes = [], $contents = '')
    {
        parent::__construct('body', $attributes, $contents);
    }
}