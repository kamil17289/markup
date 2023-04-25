<?php

include '../vendor/autoload.php';

use function Nethead\Markup\Helpers\tag;

header('Content-Type: application/json');

echo json_encode(tag('div', [], [
    'You can use the tag function helper to avoid constantly using the ',
    tag('code', [], ['new']),
    ' operator.'
]));
