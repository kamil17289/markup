<?php

namespace Nethead\Markup\Helpers;

/**
 * Trait ObfuscatesData
 * @package Nethead\Markup\Html
 */
trait ObfuscatesData {
    protected $rot13jsDecoder = '.replace(/[a-zA-Z]/g,function(c){return String.fromCharCode((c<=\'Z\'?90:122)>=(c=c.charCodeAt(0)+13)?c:c-26);})';

    /**
     * Code the string to make it harder for robots to collect data
     * @param string $data
     * @return string
     */
    protected function obfuscate(string $data = ''): string
    {
        if (empty($data))
            return '';

        return str_rot13($data);
    }

    /**
     * @param string $data
     * @return string
     */
    protected function reverse(string $data = ''): string
    {
        if (empty($data))
            return '';

        return strrev($data);
    }
}