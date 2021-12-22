<?php

include '../vendor/autoload.php';

use Nethead\Markup\Foundation\Fragment;
use Nethead\Markup\Tags\A;

$fragment = new Fragment();

$fragment->push('alterableElem', new A('https://google.com/', ['Go to Google!'], []));

// (...)
if ($fragment->has('alterableElem')) {
    $fragment->get('alterableElem')->classList()->add('btn btn-primary');
}

echo $fragment->wrap('div', ['class' => 'col-12']);