<?php

namespace Nethead\Markup\Helpers;

use Nethead\Markup\Foundation\Tag;

/**
 * Class IconsFactory.
 * A helper for easy icons rendering. You can use the code to make your own icons factory,
 * or you can extend this one if you (doubtfully) use all of those icons sets.
 *
 * @package Nethead\Markup\Helpers
 */
class IconsFactory {
    /**
     * A shortcut for rendering icons.
     * When you configure your default icons factory you can call this instead of
     * longer factory names like fontAwesome or glyphicons.
     *
     * @see HtmlConfig::$defaultIconsFactory
     * @param string $iconClass Icon class name
     * @return Tag
     */
    public static function icon(string $iconClass): Tag
    {
        return call_user_func(HtmlConfig::$defaultIconsFactory, $iconClass);
    }

    /**
     * Font Awesome icons factory.
     *
     * @see https://fontawesome.com/
     * @param string $iconClass Icon class name
     * @return Tag Tag object which will render FA icon
     */
    public static function fontAwesome(string $iconClass): Tag
    {
        return (new Tag('i', [
            'class' => 'fas fa-' . $iconClass
        ]));
    }

    /**
     * Bootstrap Glyphicons factory.
     *
     * @see https://getbootstrap.com/
     * @param string $iconClass Icon class name
     * @return Tag Tag object which will render Bootstrap icon
     */
    public static function glyphicons(string $iconClass): Tag
    {
        return (new Tag('span', [
            'aria-hidden' => 'true',
            'class' => 'glyphicon glyphicon-' . $iconClass
        ]));
    }

    /**
     * IcoFont icons factory.
     *
     * @see https://icofont.com/
     * @param string $iconClass Icon class name
     * @return Tag Tag object which will render IcoFont icon
     */
    public static function icofont(string $iconClass): Tag
    {
        return (new Tag('i', [
            'class' => 'icofont-' . $iconClass
        ]));
    }
}