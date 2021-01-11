<?php

namespace Nethead\Markup\Helpers;

use Nethead\Markup\Foundation\Tag;

if (! function_exists('tag')) {
    /**
     * A helper factory function.
     * You can use this the same way as the Tag constructor, just using the functional way,
     * without constantly typing 'new' operator. It also lets you make it easier to chain
     * methods right after the object is created.
     *
     * @see Tag::__construct
     * @param string $name Name of the tag
     * @param array $attributes Attributes array
     * @param array $children Children tags
     * @return Tag
     */
    function tag(string $name, array $attributes = [], array $children = []): Tag
    {
        return new Tag($name, $attributes, $children);
    }
}