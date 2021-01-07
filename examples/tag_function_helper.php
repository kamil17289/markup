<?php

include '../vendor/autoload.php';

use function Nethead\Markup\Helpers\tag;

echo tag('div', [], [
    'You can use the tag function helper to avoid constantly using the ',
    tag('code', [], ['new']),
    ' operator.'
]);