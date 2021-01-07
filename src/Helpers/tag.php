<?php

namespace Nethead\Markup\Helpers;

use Nethead\Markup\Foundation\Tag;

/**
 * @param string $name
 * @param array $attributes
 * @param array $children
 * @return Tag
 */
function tag(string $name, array $attributes = [], array $children = []): Tag
{
    return new Tag($name, $attributes, $children);
}