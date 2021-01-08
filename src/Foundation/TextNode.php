<?php

namespace Nethead\Markup\Foundation;

use PharIo\Manifest\InvalidApplicationNameException;

/**
 * Class TextNode is used for adding texts inside of HTML tags.
 * You can use simple strings as a child elements, but everywhere you need the input
 * to be sanitized before outputting, use this. TextNode always escapes it's contents,
 * no matter if render() method or (string) cast is used. It also contains a few useful
 * helper methods.
 * @package Nethead\Markup\Foundation
 */
class TextNode {
    /**
     * The text contents of the node
     *
     * @var string
     */
    protected $contents;

    /**
     * TextNode constructor.
     *
     * @param string $contents Contents for the node, cannot be empty
     * @throws \InvalidArgumentException When you try creating empty text node
     */
    public function __construct(string $contents)
    {
        if (empty($contents)) {
            throw new \InvalidArgumentException('TextNode can only be created with not empty string.');
        }

        $this->contents = $contents;
    }

    /**
     * Helper method for fast creating new text nodes.
     * Helps with method chaining.
     *
     * @param string $contents Contents for the node, cannot be empty
     * @return TextNode
     */
    public static function make(string $contents): TextNode
    {
        return new self($contents);
    }

    /**
     * Append some characters at the end of the string.
     *
     * @param string $contents Contents that will be appended at the end
     * @return TextNode
     */
    public function append(string $contents) : TextNode
    {
        $this->contents .= $contents;
        return $this;
    }

    /**
     * Render the contents as a safe HTML string.
     * Uses htmlspecialchars to escape unsafe strings into safe ones.
     *
     * @see https://www.php.net/manual/en/function.htmlspecialchars.php for PHP documentation on double encoding
     * @param bool $doubleEncode When double_encode is turned off PHP will not encode existing html entities, the default is to convert everything.
     * @return string String escaped with the php's htmlspecialchars function
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
     * Magic method for casting the object to a string type.
     * Always converts with $doubleEncode = true
     *
     * @see TextNode::render() for more information
     * @return string
     */
    public function __toString() : string
    {
        return $this->render();
    }
}