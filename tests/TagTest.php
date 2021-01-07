<?php

use PHPUnit\Framework\TestCase;
use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Foundation\TextNode;
use Nethead\Markup\Helpers\HtmlConfig;

class TagTest extends TestCase {
    public function testCantBeCreatedWithoutName()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Tag name cannot be empty!');

        new Tag('');
    }

    /**
     * @return Tag
     */
    public function testCanRenderTagsWithAttributes()
    {
        $tag = new Tag('p', ['class' => 'paragraph'], [
            new TextNode('Paragraph contents')
        ]);

        $expected = '<p class="paragraph">Paragraph contents</p>';

        $this->assertEquals($expected, (string) $tag);

        return $tag;
    }

    public function testCanRenderVoidTags()
    {
        $tag = new Tag('br');

        $this->assertEquals('<br>', (string) $tag);
    }

    public function testCanRenderClosedVoidTags()
    {
        HtmlConfig::$closeVoids = true;

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
            'p1' => $child,
            'hr' => new Tag('hr')
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
    public function testChildrenCanBeCleared(Tag $tag) : Tag
    {
        $tag->clearChildren();

        $this->assertEquals('<div class="alert alert-info"></div>', (string) $tag);

        return $tag;
    }

    /**
     * @param Tag $tag
     * @depends testChildrenCanBeCleared
     * @return Tag
     */
    public function testChildrenCanBeSet(Tag $tag)
    {
        $expected = '<div class="alert alert-info"><a href="/">Home</a></div>';

        $tag->setChildren([
            new Tag('a', ['href' => '/'], [
                new TextNode('Home')
            ])
        ]);

        $this->assertEquals($expected, (string) $tag);

        return $tag;
    }

    public function testCanCheckIfIsVoid()
    {
        $tagVoid = new Tag('br');
        $tagNormal = new Tag('p');

        $this->assertTrue($tagVoid->isVoidElement());
        $this->assertFalse($tagNormal->isVoidElement());
    }

    /**
     * @depends testChildrenCanBeSet
     * @param Tag $tag
     */
    public function testChildrenCanRendered(Tag $tag)
    {
        $expected = '<a href="/">Home</a>';

        $this->assertEquals($expected, $tag->renderChildren());
    }

    public function testChildrenCanBeAccessedByName()
    {
        $tag = new Tag('div', [], [
            'title' => new Tag('h1', [], ['A title of level 1']),
            'text' => new Tag('p', [], ['This is a very useful package to have'])
        ]);

        $this->assertInstanceOf(Tag::class, $tag->getChild('title'));

        $this->assertEquals('<p>This is a very useful package to have</p>', $tag->getChild('text')->render());

        $tag->removeChild('text');

        $this->assertEquals(1, count($tag->children));

        $tag->addChildren([
            'image' => new Tag('img', ['src' => '/test.png'])
        ]);

        $this->assertEquals('<img src="/test.png"/>', $tag->getChild('image')->render());
    }
}