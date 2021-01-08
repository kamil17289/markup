<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Creates a HTML "table".
 *
 * @package Nethead\Markup\Tags
 */
class Table extends Tag {
    /**
     * Table constructor.
     *
     * @param array $attributes
     *  Additional HTML attributes you want to add
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct('table', $attributes, [
            'thead' => new Tag('thead', [], ['row' => new Tag('tr')]),
            'tbody' => new Tag('tbody')
        ]);
    }

    /**
     * Static helper for creating tables.
     *
     * @param array $attributes
     *  Additional HTML attributes you want to add
     * @return Table
     */
    public static function make(array $attributes = []): Table
    {
        return new self($attributes);
    }

    /**
     * Define the headers for the table.
     *
     * @param array $headers
     *  Array of strings to be placed as headers for the table
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
     * Add data row to the table.
     *
     * @param array $data
     *  Array of strings to be placed as data row in the table.
     *  *Important:* make sure that that length of the array matches the number of header cells.
     */
    public function row(array $data)
    {
        $this->getChild('tbody')->addChildren([
            new Tag('tr', [], $data)
        ]);
    }
}