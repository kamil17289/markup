<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Creates a "html" root element.
 *
 * @package Nethead\Markup\Tags
 */
class Html extends Tag {
    /**
     * Html constructor.
     *
     * @param string $lang
     *  Language of the document, two-letters code. See https://www.w3schools.com/tags/ref_language_codes.asp
     * @param array $children
     *  Child elements that will be put inside (images, texts, whatever)
     * @param array $attributes
     *  Additional HTML attributes you want to add
     */
    public function __construct(string $lang = 'en', array $attributes = [], array $children = [])
    {
        parent::__construct('html', $attributes, $children);

        $this->attrs()->set('lang', $lang);
    }
}