<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Helpers\ObfuscatesData;

/**
 * Class Mailto
 * @package Nethead\Markup\Html
 */
class Mailto extends Tag {
    use ObfuscatesData;

    /**
     * Mailto constructor.
     * @param string $email
     * @param string $contents
     * @param array $attributes
     */
    public function __construct(string $email, string $contents, array $attributes = [])
    {
        $attributes = array_merge($attributes, [
            'href' => 'javascript:void(0);',
            'data-address' => $this->obfuscate($email),
            'style' => 'direction: rtl; unicode-bidi: bidi-override;',
            'onclick' => "window.location.href='mailto:'+this.dataset.address" . $this->rot13jsDecoder
        ]);

        parent::__construct('a', $attributes, [$this->reverse($contents)]);
    }
}