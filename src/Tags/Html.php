<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Class Html
 * @package Nethead\Markup\Tags
 */
class Html extends Tag {
    /**
     * Html constructor.
     * @param string $lang
     * @param array $attributes
     * @param array $children
     */
    public function __construct(string $lang = 'en', array $attributes = [], array $children = [])
    {
        parent::__construct('html', $attributes, $children);

        $this->attrs()->set('lang', $lang);
    }
}