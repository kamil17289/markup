<?php

namespace Nethead\Markup\Tags;

class Html extends Tag {
    public function __construct(string $lang = 'en', array $attributes = [], $contents = '')
    {
        parent::__construct('html', $attributes, $contents);

        $this->setHtmlAttribute('lang', $lang);
    }
}