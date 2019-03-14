<?php

namespace Nethead\Markup\Html;

/**
 * Trait ObfuscatesData
 * @package Nethead\Markup\Html
 */
trait ObfuscatesData {
    /**
     * Code the string to make it harder for robots to collect data
     * @param string $data
     * @return string
     */
    protected function obfuscate(string $data = '')
    {
        if (empty($data))
            return '';

        return $data;
    }
}