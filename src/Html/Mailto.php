<?php

namespace Nethead\Markup\Html;

/**
 * Class Mailto
 * @package Nethead\Markup\Html
 */
class Mailto extends A {
    use ObfuscatesData;

    /**
     * Mailto constructor.
     * @param string $href
     * @param string $contents
     * @param array $attributes
     */
    public function __construct($href, $contents, array $attributes = [])
    {
        $href = 'mailto:' . $this->obfuscate($href);

        parent::__construct($href, $contents, $attributes);
    }
}