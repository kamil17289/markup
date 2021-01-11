<?php

use \PHPUnit\Framework\TestCase;
use \Nethead\Markup\Foundation\TextNode;

final class TextNodeTest extends TestCase {
    public function testCanBeCreatedFromString()
    {
        $testString = 'This is a TextNode';

        $node = new TextNode($testString);

        $this->assertInstanceOf(TextNode::class, $node);

        return $node;
    }

    public function testCannotBeCreatedWithEmptyString()
    {
        $testValue = '';

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('TextNode can only be created with not empty string.');

        $node = new TextNode('');
    }

    /**
     * @param TextNode $node
     * @depends testCanBeCreatedFromString
     */
    public function testCanBeStringified(TextNode $node)
    {
        $this->assertEquals('This is a TextNode', (string) $node);
    }

    /**
     * @param TextNode $node
     * @depends testCanBeCreatedFromString
     */
    public function testStringCanBeAppended($node)
    {
        $node->append(' with appended text.');

        $this->assertEquals('This is a TextNode with appended text.', $node->__toString());
    }
}