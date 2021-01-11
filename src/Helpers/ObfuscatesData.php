<?php

namespace Nethead\Markup\Helpers;

/**
 * Trait ObfuscatesData.
 * Uses a weird technique to obfuscate data. It can hide anything from crawlers and robots,
 * for example your e-mail address. It uses a simple rot13 encryption (not very strong but tricky for robots)
 * for encrypting your important data you can decode with the simple JS call below.
 *
 * @see \Nethead\Markup\Tags\Mailto For more information on how to obfuscate your data in HTML
 * @package Nethead\Markup\Html
 */
trait ObfuscatesData {
    protected $rot13jsDecoder = '.replace(/[a-zA-Z]/g,function(c){return String.fromCharCode((c<=\'Z\'?90:122)>=(c=c.charCodeAt(0)+13)?c:c-26);})';

    /**
     * Code the string to make it harder for robots to collect data.
     *
     * @param string $data Data you want to encode.
     * @return string Data encoded with simple rot13 encoding.
     */
    protected function obfuscate(string $data = ''): string
    {
        if (empty($data))
            return '';

        return str_rot13($data);
    }

    /**
     * Reverse the string.
     *
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