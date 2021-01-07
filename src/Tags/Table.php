<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Class Table
 * @package Nethead\Markup\Tags
 */
class Table extends Tag {
    /**
     * Table constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct('table', $attributes, [
            'thead' => new Tag('thead', [], ['row' => new Tag('tr')]),
            'tbody' => new Tag('tbody')
        ]);
    }

    /**
     * @param array $attributes
     * @return Table
     */
    public static function make(array $attributes = []): Table
    {
        return new self($attributes);
    }

    /**
     * @param array $headers
     */
    public function head(array $headers)
    {
        $this->getChild('thead')->getChild('row')->setChildren(
            array_map(function ($item) {
                return new Tag('th', [], [$item]);
            }, $headers)
        );
    }

    /**
     * @param array $data
     */
    public function row(array $data)
    {
        $this->getChild('tbody')->addChildren([
            new Tag('tr', [], [$data])
        ]);
    }
}