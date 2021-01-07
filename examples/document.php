<?php

include '../vendor/autoload.php';

use Nethead\Markup\Foundation\Document;
use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\MarkupFactory;

$doc = new Document('en');

$bootstrapStyles = MarkupFactory::stylesheet('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css')
    ->with(function(Tag $t) {
        $t->attrs()->setMany([
            'integrity' => 'sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1',
            'crossorigin' => 'anonymous'
        ]);
    });

$doc->title('The whole document generated!')
    ->charset()
    ->meta('author', 'Kamil Gałkiewicz')
    ->toHead([
        MarkupFactory::viewport(),
        $bootstrapStyles
    ]);

$doc->body()->addChildren([
    new Tag('div', ['class' => 'container'], [
        new Tag('div', ['class' => 'row'], [
            new Tag('div', ['class' => 'col'], [
                new Tag('h1', [], ['This document is created using the object oriented PHP!']),
                new Tag('div', ['class' => 'alert alert-primary'], [
                    new Tag('p', [], ['How nicer is it compared to Drupal rendering arrays?'])
                ])
            ])
        ])
    ])
]);

echo $doc;