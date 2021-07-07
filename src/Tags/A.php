<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Foundation\TextNode;
use Nethead\Markup\Helpers\ObfuscatesData;

/**
 * Creates "a" element.
 *
 * @see https://www.w3schools.com/tags/tag_a.asp
 * @package Nethead\Markup\Tags
 */
class A extends Tag {
    use ObfuscatesData;

    /**
     * A constructor.
     *
     * @param string $href
     *  The URL you want to link to
     * @param array $children
     *  Child elements that will be put inside the link (images, texts, whatever)
     * @param array $attributes
     *  Additional HTML attributes you want to add
     */
    public function __construct(string $href, array $children, array $attributes = [])
    {
        parent::__construct('a', $attributes, $children);

        $this->attrs()->set('href', $href);
    }

    /**
     * Convert the link into mailto: link with obfuscated email address.
     * Make sure you set the email address as link's href attribute.
     * DO NOT add "mailto:" at the beginning of the href.
     *
     * @return A
     */
    public function mailto(): A
    {
        foreach($this->children as $name => $child) {
            if (is_string($this->children[$name])) {
                $this->children[$name] = $this->reverse($this->children[$name]);
            }
            elseif ($this->children[$name] instanceof TextNode) {
                $this->children[$name]->alter([$this, 'reverse']);
            }
        }

        $email = $this->attrs()->get('href');

        $this->attrs()->setMany([
            'href' => 'javascript:void(0);',
            'data-address' => $this->obfuscate($email),
            'style' => 'direction: rtl; unicode-bidi: bidi-override;',
            'onclick' => "window.location.href='mailto:'+this.dataset.address" . $this->rot13jsDecoder
        ]);

        return $this;
    }

    /**
     * Helper function for indicating download link.
     *
     * @return A
     */
    public function download(): A
    {
        $this->attrs()->set('download', true);

        return $this;
    }

    /**
     * Helper function for setting target frame
     *
     * @param string $targetWindow Target window name
     * @return A
     */
    public function target(string $targetWindow): A
    {
        $this->attrs()->set('target', $targetWindow);

        return $this;
    }

    /**
     * Helper function to set the link to open in new tab.
     *
     * @return A
     */
    public function blank(): A
    {
        $this->attrs()->set('target', '_blank');

        return $this;
    }

    /**
     * Set the relation of the link.
     *
     * @param string $relation
     */
    public function rel(string $relation)
    {
        $this->attrs()->set('rel', $relation);
    }
}