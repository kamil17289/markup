<?php

use PHPUnit\Framework\TestCase;
use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Foundation\TextNode;

class TagTest extends TestCase {
    public function testCantBeCreatedWithoutName()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Tag name cannot be empty!');

        $tag = new Tag('');
    }

    /**
     * @return Tag
     */
    public function testCanRenderTagsWithAttributes()
    {
        $tag = new Tag('p', ['class' => 'paragraph'], [
            new TextNode('Paragraph contents')
        ]);

        $this->assertEquals('<p class="paragraph">Paragraph contents</p>', (string) $tag);

        return $tag;
    }

    public function testCanRenderVoidTags()
    {
        $tag = new Tag('br');

        $this->assertEquals('<br>', (string) $tag);
    }

    public function testCanRenderClosedVoidTags()
    {
        Tag::$closeVoids = true;

        $tag = new Tag('br');

        $this->assertEquals('<br/>', (string) $tag);
    }

    /**
     * @param Tag $child
     * @depends testCanRenderTagsWithAttributes
     * @return Tag
     */
    public function testCanRenderTagsWithAttributesAndChildren(Tag $child) : Tag
    {
        $tree = new Tag('div', ['class' => 'alert alert-info'], [
            $child,
            new Tag('hr')
        ]);

        $expected = '<div class="alert alert-info"><p class="paragraph">Paragraph contents</p><hr/></div>';

        $this->assertEquals($expected, (string) $tree);

        return $tree;
    }

    /**
     * @param Tag $tag
     * @depends testCanRenderTagsWithAttributesAndChildren
     * @return Tag
     */
    public function testContentsCanBeCleared(Tag $tag) : Tag
    {
        $tag->clearContents();

        $this->assertEquals('<div class="alert alert-info"></div>', (string) $tag);

        return $tag;
    }

    /**
     * @param Tag $tag
     * @depends testContentsCanBeCleared
     */
    public function testContentsCanBeSet(Tag $tag)
    {
        $expected = '<div class="alert alert-info"><a href="/">Home</a></div>';

        $tag->setContents([
            new Tag('a', ['href' => '/'], [
                new TextNode('Home')
            ])
        ]);

        $this->assertEquals($expected, (string) $tag);
    }
}