<?php

namespace Nethead\Markup;

class Emoji {
    public static $emojis = [
        'wristwatch' => '8986',
        'hourglass'  => '8987',

    ];

    public function __invoke($emoji)
    {
        return sprintf('&#%s;', self::$emojis[$emoji]);
    }
}