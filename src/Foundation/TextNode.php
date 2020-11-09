<?php

namespace Nethead\Markup\Foundation;

/**
 * Class TextNode
 * @package Nethead\Markup\Foundation
 */
class TextNode {
    /**
     * @var string
     */
    protected $contents;

    /**
     * TextNode constructor.
     * @param string $contents
     */
    public function __construct(string $contents)
    {
        $this->contents = $contents;
    }

    /**
     * @param string $contents
     * @return $this
     */
    public function append(string $contents) : TextNode
    {
        $this->contents .= $contents;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return htmlspecialchars($this->contents);
    }
}