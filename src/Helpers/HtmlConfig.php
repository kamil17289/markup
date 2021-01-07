<?php

namespace Nethead\Markup\Helpers;

class HtmlConfig {
    /**
     * HTML 5.3 void elements
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
     * Global attributes supported by every HTML tag
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
     * @var bool
     */
    public static $closeVoids = false;

    /**
     * List of attributes which value shouldn't be escaped
     * @var array
     */
    public static $notEscapedAttributes = [
        'onclick' // can't be escaped to make ObfuscatesData work
    ];
}