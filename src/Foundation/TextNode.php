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
        if (empty($contents)) {
            throw new \InvalidArgumentException('TextNode can only be created with not empty string.');
        }

        $this->contents = $contents;
    }

    /**
     * @param string $contents
     * @return TextNode
     */
    public static function make(string $contents): TextNode
    {
        return new self($contents);
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
     * @param bool $doubleEncode
     * @return string
     */
    public function render(bool $doubleEncode = true): string
    {
        return htmlspecialchars(
            $this->contents,
            ENT_HTML5,
            'UTF-8',
            $doubleEncode
        );
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->render();
    }
}