<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

class Audio extends Tag {
    public function __construct(string $name, array $attributes = [], array $children = [])
    {
        parent::__construct($name, $attributes, $children);
    }
}