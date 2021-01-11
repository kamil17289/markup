<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Foundation\TextNode;
use Nethead\Markup\Helpers\CanHaveMediaControls;

/**
 * Class Video creates a "video" tags
 *
 * @package Nethead\Markup\Tags
 */
class Video extends Tag {
    use CanHaveMediaControls;

    /**
     * Set this message with your own and show for older browsers.
     *
     * @var string
     */
    public $notSupportedMessege = 'Your browser does not support the video tag.';

    /**
     * Video constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct('video', $attributes);
    }

    /**
     * Add a video source.
     *
     * @param string $src src attribute value, a URL basically
     * @param string $type MIME type of the video
     * @return Video
     */
    public function source(string $src, string $type): Video
    {
        $this->addChildren([
            Source::make()
                ->src($src)
                ->type($type)
        ]);

        return $this;
    }

    /**
     * Set the poster image for the video.
     *
     * @param string $src
     * @return Video
     */
    public function poster(string $src): Video
    {
        $this->attrs()->set('poster', $src);
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