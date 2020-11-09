<?php

include '../vendor/autoload.php';

use \Nethead\Markup\Foundation\Tag;
use \Nethead\Markup\Foundation\RichTextNode;

$text = new RichTextNode();

$text->h(1, 'Great example of Nethead Markup package usage.');

$text->plain('This is a ')
    ->strong('<p>')
    ->plain('aragraph ')
    ->underline('generated by the package.');

$text->plain(' You break the lines')
    ->br()
    ->plain('inside the paragraph as you wish.');

$tag = new Tag('p', ['class' => 'paragpraph'], [$text]);

echo $tag->__toString();