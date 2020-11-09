<?php

namespace Nethead\Markup\Foundation;

use mysql_xdevapi\RowResult;

/**
 * Class RichTextNode
 * @package Nethead\Markup\Foundation
 */
class RichTextNode {
    /**
     * @var array
     */
    protected $contents;

    /**
     * RichTextNode constructor.
     * @param array $contents
     */
    public function __construct(array $contents = [])
    {
        $this->contents = $contents;
    }

    /**
     * @param int $type
     * @param string $text
     * @return $this
     */
    public function h(int $type, string $text) : RichTextNode
    {
        $this->contents[] = new Tag("h$type", [], [new TextNode($text)]);
        return $this;
    }

    /**
     * @return $this
     */
    public function br() : RichTextNode
    {
        $this->contents[] = new Tag('br');
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function plain(string $text) : RichTextNode
    {
        $this->contents[] = new TextNode($text);
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function strong(string $text) : RichTextNode
    {
        $this->contents[] = new Tag('strong', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * Alias for strong()
     * @param string $text
     * @return $this
     */
    public function b(string $text) : RichTextNode
    {
        return $this->strong($text);
    }

    /**
     * @param string $text
     * @return $this
     */
    public function underline(string $text) : RichTextNode
    {
        $this->contents[] = new Tag('u', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * @param string $text
     * @param string $title
     * @return $this
     */
    public function abbr(string $text, string $title)
    {
        $this->contents[] = new Tag('abbr', ['title' => $title], [new TextNode($text)]);
        return $this;
    }

    /**
     * @param string $text
     * @param string $url
     * @return RichTextNode
     */
    public function quote(string $text, string $url = '') : RichTextNode
    {
        $this->contents[] = new Tag('blockquote', ['cite' => $url], [new TextNode($text)]);
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function del(string $text) : RichTextNode
    {
        $this->contents[] = new Tag('del', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function ins(string $text) : RichTextNode
    {
        $this->contents[] = new Tag('ins', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function em(string $text) : RichTextNode
    {
        $this->contents[] = new Tag('em', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function i(string $text) : RichTextNode
    {
        $this->contents[] = new Tag('i', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function hr(string $text) : RichTextNode
    {
        $this->contents[] = new Tag('hr', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function kbd(string $text) : RichTextNode
    {
        $this->contents[] = new Tag('kbd', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function q(string $text) : RichTextNode
    {
        $this->contents[] = new Tag('q', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * @param string $text
     * @param string $classes
     * @return $this
     */
    public function span(string $text, string $classes) : RichTextNode
    {
        $this->contents[] = new Tag('span', ['class' => $classes], [new TextNode($text)]);
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function sup(string $text) : RichTextNode
    {
        $this->contents[] = new Tag('sup', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function sub(string $text) : RichTextNode
    {
        $this->contents[] = new Tag('sub', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function time(string $text) : RichTextNode
    {
        $this->contents[] = new Tag('time', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function wbr() : RichTextNode
    {
        $this->contents[] = new Tag('wbr');
        return $this;
    }

    /**
     * @return string
     */
    public function __toString() :string
    {
        return implode('', $this->contents);
    }
}