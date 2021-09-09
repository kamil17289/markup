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
     * Check if the element is present within the fragment.
     * @param $name
     * @return bool
     */
    public function has($name): bool
    {
        return array_key_exists($name, $this->contents);
    }

    /**
     * Get an array of all Tags inside the fragment.
     * @return array
     */
    public function toArray(): array
    {
        return $this->contents;
    }

    /**
     * Wrap the contents inside the custom container.
     * @param string $wrapper
     * @param array $attributes
     * @return Tag
     */
    public function wrap(string $wrapper, array $attributes = []): Tag
    {
        return new Tag($wrapper, $attributes, [$this->contents]);
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