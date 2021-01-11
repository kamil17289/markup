<?php

namespace Nethead\Markup\Foundation;

/**
 * Creates rich formatted texts in HTML.
 * It has many chainable methods to make it easier and quicker to create many tags inside and format
 * the text as you need, using bold, underline, italics, superscripts and other formatting options.
 * It is like a factory, but adds all its children to internal storage, so they can be quickly
 * rendered at once when you cast it to string.
 * @package Nethead\Markup\Foundation
 */
class RichTextNode {
    /**
     * The contents of the node
     *
     * @var array
     */
    protected $contents;

    /**
     * RichTextNode constructor.
     *
     * @param array $contents The contents for the created node
     */
    public function __construct(array $contents = [])
    {
        $this->contents = $contents;
    }

    /**
     * Add a HTML header of desired level (1-6)
     *
     * @param int $type
     *  Header level, you can use any integer as this doesn't validate anything.
     *  Just remember HTML supports only headers from h1 to h6
     * @param string $text
     *  The text you want in the header, as plain string
     * @return RichTextNode
     */
    public function h(int $type, string $text): RichTextNode
    {
        $this->contents[] = new Tag("h$type", [], [new TextNode($text)]);
        return $this;
    }

    /**
     * Create a line break.
     *
     * @return RichTextNode
     */
    public function br(): RichTextNode
    {
        $this->contents[] = new Tag('br');
        return $this;
    }

    /**
     * Add a plain text.
     *
     * @param string $text The text you want to add
     * @return RichTextNode
     */
    public function plain(string $text): RichTextNode
    {
        $this->contents[] = new TextNode($text);
        return $this;
    }

    /**
     * Add a bold text using &lt;strong&gt; element.
     *
     * @param string $text The text you want to add
     * @return $this
     */
    public function strong(string $text) : RichTextNode
    {
        $this->contents[] = new Tag('strong', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * Alias for strong()
     *
     * @see RichTextNode::strong()
     * @param string $text The text you want to add
     * @return RichTextNode
     */
    public function b(string $text): RichTextNode
    {
        return $this->strong($text);
    }

    /**
     * Add underlined text using &lt;u&gt; tag
     *
     * @param string $text The text you want to add
     * @return RichTextNode
     */
    public function underline(string $text): RichTextNode
    {
        $this->contents[] = new Tag('u', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * Add abbreviation to your text
     *
     * @param string $text The text you want to add
     * @param string $title The title attribute for the abbreviation
     * @return RichTextNode
     */
    public function abbr(string $text, string $title): RichTextNode
    {
        $this->contents[] = new Tag('abbr', ['title' => $title], [new TextNode($text)]);
        return $this;
    }

    /**
     * Add a &lt;blockquote&gt; to your text.
     *
     * @param string $text The quoted text you want to add
     * @param string $url The source url of the citation
     * @return RichTextNode
     */
    public function quote(string $text, string $url = ''): RichTextNode
    {
        $this->contents[] = new Tag('blockquote', ['cite' => $url], [new TextNode($text)]);
        return $this;
    }

    /**
     * Add a strikethrough text using &lt;del&gt; element.
     *
     * @param string $text The text you want to add
     * @return RichTextNode
     */
    public function del(string $text): RichTextNode
    {
        $this->contents[] = new Tag('del', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * Add "inserted" text.
     *
     * @param string $text The text you want to add
     * @return RichTextNode
     */
    public function ins(string $text): RichTextNode
    {
        $this->contents[] = new Tag('ins', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * Add emphasised text.
     *
     * @param string $text The text you want to add
     * @return RichTextNode
     */
    public function em(string $text): RichTextNode
    {
        $this->contents[] = new Tag('em', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * Add simple italic text using &lt;i&gt; element.
     *
     * @param string $text The text you want to add
     * @return RichTextNode
     */
    public function i(string $text): RichTextNode
    {
        $this->contents[] = new Tag('i', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * Add a horizontal line
     *
     * @param string $text The text you want to add
     * @return RichTextNode
     */
    public function hr(string $text): RichTextNode
    {
        $this->contents[] = new Tag('hr', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * Add a keyboard input.
     *
     * @param string $text The text you want to add
     * @return RichTextNode
     */
    public function kbd(string $text): RichTextNode
    {
        $this->contents[] = new Tag('kbd', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * Add a quotation using &lt;q&gt; element.
     *
     * @param string $text The text you want to add
     * @return RichTextNode
     */
    public function q(string $text): RichTextNode
    {
        $this->contents[] = new Tag('q', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * Add a &lt;span&gt; element with custom CSS classes
     *
     * @param string $text The text you want to add
     * @param string $classes
     * @return RichTextNode
     */
    public function span(string $text, string $classes): RichTextNode
    {
        $this->contents[] = new Tag('span', ['class' => $classes], [new TextNode($text)]);
        return $this;
    }

    /**
     * Add a superscript.
     *
     * @param string $text The text you want to add
     * @return RichTextNode
     */
    public function sup(string $text): RichTextNode
    {
        $this->contents[] = new Tag('sup', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * Add a subscript.
     *
     * @param string $text The text you want to add
     * @return RichTextNode
     */
    public function sub(string $text): RichTextNode
    {
        $this->contents[] = new Tag('sub', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * Add a time element.
     *
     * @param string $text The text you want to add
     * @return RichTextNode
     */
    public function time(string $text): RichTextNode
    {
        $this->contents[] = new Tag('time', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * Add a line break opportunity.
     *
     * @return RichTextNode
     */
    public function wbr(): RichTextNode
    {
        $this->contents[] = new Tag('wbr');
        return $this;
    }

    /**
     * Add a marked/highlighted text.
     *
     * @param string $text The text you want to add
     * @return RichTextNode
     */
    public function mark(string $text): RichTextNode
    {
        $this->contents[] = new Tag('mark', [], [new TextNode($text)]);
        return $this;
    }

    /**
     * Convert the RichTextNode to HTML string
     * @return string
     */
    public function __toString() :string
    {
        return implode('', $this->contents);
    }
}