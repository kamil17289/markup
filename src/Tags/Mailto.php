<?php

namespace Nethead\Markup\Tags;

/**
 * Class Mailto
 * @package Nethead\Markup\Html
 */
class Mailto extends Tag {
    use ObfuscatesData;

    /**
     * List of attributes which value shouldn't be escaped
     * @var array
     */
    protected $notEscapedAttributes = ['onclick'];

    /**
     * Mailto constructor.
     * @param string $href
     * @param string $contents
     * @param array $attributes
     */
    public function __construct($href, $contents, array $attributes = [])
    {
        $attributes = array_merge($attributes, [
            'href' => 'javascript:void(0);',
            'data-address' => $this->obfuscate($href),
            'style' => 'direction: rtl; unicode-bidi: bidi-override;',
            'onclick' => "window.location.href='mailto:'+this.dataset.address" . $this->rot13jsDecoder
        ]);

        parent::__construct('a', $attributes, $this->reverse($contents));
    }
}