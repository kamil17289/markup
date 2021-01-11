<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Foundation\TextNode;
use Nethead\Markup\Helpers\CanHaveMediaControls;

/**
 * Class Audio creates "audio" tags.
 *
 * @package Nethead\Markup\Tags
 */
class Audio extends Tag {
    use CanHaveMediaControls;

    /**
     * Set this message with your own and show for older browsers.
     *
     * @var string
     */
    public $notSupportedMessege = 'Your browser does not support the audio tag.';

    /**
     * Audio constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct('audio', $attributes);
    }

    /**
     * Add a audio source.
     *
     * @param string $src src attribute value, a URL basically
     * @param string $type MIME type of the video
     * @return Audio
     */
    public function source(string $src, string $type): Audio
    {
        $this->addChildren([
            Source::make()
                ->src($src)
                ->type($type)
        ]);

        return $this;
    }

    /**
     * Renders the object into HTML string
     *
     * @return string
     */
    public function render(): string
    {
        $message = new TextNode($this->notSupportedMessege);

        return $this->open() . $this->renderChildren() . $message . $this->close();
    }
}