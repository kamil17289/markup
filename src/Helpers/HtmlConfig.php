<?php

namespace Nethead\Markup\Helpers;

/**
 * Class HtmlConfig.
 * Stores the configuration for the HTML Foundation.
 * Everything can be overwritten at runtime as it is all public and static.
 * See below for more documentation on configuration options.
 *
 * @package Nethead\Markup\Helpers
 */
class HtmlConfig {
    /**
     * HTML 5.3 void elements list.
     * Void elements (tags) are elements that can't have children elements and are closed right away.
     * They still can have attributes. HTML Foundation is using this array to decide how and when the
     * tag should be closed, and if it can have child elements.
     * You can add more tags if you need to by calling `HtmlConfig::$voidElements[] = 'yourTagName';`
     *
     * @var array
     */
    public static $voidElements= [
        'area',
        'base',
        'br',
        'col',
        'embed',
        'hr',
        'img',
        'input',
        'link',
        'meta',
        'param',
        'source',
        'track',
        'wbr'
    ];

    /**
     * Global attributes supported by every HTML tag.
     * If you have a need to quickly add some attribute on all tags, you can add it to global attributes list like this:
     * `HtmlConfig::$globalAttributes[] = 'yourTagName';`. *Remember:* Not all attributes can be added on some elements
     * according to HTML standard. It's your responsibility if the HTML will validate.
     *
     * @see \Nethead\Markup\Foundation\Tag::__call
     * @var array
     */
    public static $globalAttributes = [
        'accesskey',
        'class',
        'contenteditable',
        'dir',
        'draggable',
        'dropzone',
        'hidden',
        'id',
        'lang',
        'spellcheck',
        'style',
        'tabindex',
        'title',
        'translate'
    ];

    /**
     * If set to true, void tags will be always closed. Useful when you are working in XHTML.
     *
     * @var bool
     */
    public static $closeVoids = false;

    /**
     * List of attributes which value shouldn't be escaped.
     *
     * @var array
     */
    public static $notEscapedAttributes = [
        'onclick' // can't be escaped to make ObfuscatesData work
    ];

    /**
     * Change if you have your own factory or you want to use diferent icons set.
     *
     * @var callable Default function for rendering the icons.
     */
    public static $defaultIconsFactory = [IconsFactory::class, 'fontAwesome'];
}