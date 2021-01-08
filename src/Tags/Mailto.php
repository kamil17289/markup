<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Helpers\ObfuscatesData;

/**
 * Creates a mailto: link.
 * The object is trying to hide the email adrress from the crawlers and robots.
 *
 * @package Nethead\Markup\Tags
 */
class Mailto extends Tag {
    use ObfuscatesData;

    /**
     * Mailto constructor.
     * @param string $email
     *  E-mail address that will be hidden from robots
     * @param string $linkText
     *  Text that will be displayed in the link
     * @param array $attributes
     *  Additional HTML attributes you want to add
     */
    public function __construct(string $email, string $linkText, array $attributes = [])
    {
        $attributes = array_merge($attributes, [
            'href' => 'javascript:void(0);',
            'data-address' => $this->obfuscate($email),
            'style' => 'direction: rtl; unicode-bidi: bidi-override;',
            'onclick' => "window.location.href='mailto:'+this.dataset.address" . $this->rot13jsDecoder
        ]);

        parent::__construct('a', $attributes, [$this->reverse($linkText)]);
    }
}