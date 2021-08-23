<?php

namespace Nethead\Markup\Foundation;

/**
 * Class Fragment holds a number of HTML Tag objects for grouping purposes.
 * @package Nethead\Markup\Foundation
 */
class Fragment {
    /**
     * The contents of the fragment
     *
     * @var array
     */
    protected $contents;

    /**
     * Fragment constructor.
     * @param array $contents The contents for the created fragment
     */
    public function __construct(array $contents = [])
    {
        $this->contents = $contents;
    }

    /**
     * Push new tag at the end of the fragment.
     * @param string $name
     * @param Tag $tag
     */
    public function push(string $name, Tag $tag)
    {
        if (empty($name)) {
            $this->contents[] = $tag;
        }
        else {
            $this->contents[$name] = $tag;
        }
    }

    /**
     * Get a Tag from the specified index.
     * @param $index int|string The index to retrieve
     * @param null $default Value that is returned when the specified index doesn't exist
     * @return Tag
     */
    public function get($index, $default = null): Tag
    {
        if (isset($this->contents[$index])) {
            return $this->contents[$index];
        }

        return $default;
    }

    /**
     * Convert the Fragment to HTML string
     * @return string
     */
    public function __toString() :string
    {
        return implode('', $this->contents);
    }
}