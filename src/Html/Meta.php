<?php

namespace Nethead\Markup\Html;

use Illuminate\Support\HtmlString;

/**
 * Class Meta
 * @package Nethead\Markup\Html
 */
class Meta extends Tag {
    public function __construct(string $name, string $content)
    {
        parent::__construct('meta', [
            'name' => $name,
            'content' => $content
        ]);
    }

    public static function charset(string $charset)
    {
        return new HtmlString(sprintf('<meta charset="%s">', $charset));
    }
}