<?php

namespace Nethead\Markup\Helpers;

use Nethead\Markup\Foundation\Tag;

/**
 * Class IconsFactory
 * @package Nethead\Markup\Helpers
 */
class IconsFactory {
    /**
     * @param string $iconClass
     * @return Tag
     */
    public static function fontAwesome(string $iconClass): Tag
    {
        return (new Tag('i', [
            'class' => 'fas fa-' . $iconClass
        ]));
    }

    /**
     * @param string $iconClass
     * @return Tag
     */
    public static function glyphicons(string $iconClass): Tag
    {
        return (new Tag('span', [
            'aria-hidden' => 'true',
            'class' => 'glyphicon glyphicon-' . $iconClass
        ]));
    }

    /**
     * @param string $iconClass
     * @return Tag
     */
    public static function icofont(string $iconClass): Tag
    {
        return (new Tag('i', [
            'class' => 'icofont-' . $iconClass
        ]));
    }
}