<?php

namespace Nethead\Markup\Helpers;

/**
 * Trait CanHaveMediaControls.
 * Add this trait to any implementation that supports media object attributes:
 * controls, autoplay, loop, muted, preload
 *
 * @package Nethead\Markup\Helpers
 */
trait CanHaveMediaControls {
    /**
     * Specifies that video controls should be displayed
     *
     * @param $value
     * @return $this
     */
    public function controls($value)
    {
        $this->attrs()->set('controls', (bool) $value);
        return $this;
    }

    /**
     * Specifies that the video/audio will start playing as soon as it is ready
     *
     * @param $value
     * @return $this
     */
    public function autoplay($value)
    {
        $this->attrs()->set('autoplay', (bool) $value);
        return $this;
    }

    /**
     * Specifies that the video/audio will start over again, every time it is finished
     *
     * @param $value
     * @return $this
     */
    public function loop($value)
    {
        $this->attrs()->set('loop', (bool) $value);
        return $this;
    }

    /**
     * Specifies that the audio output of the video/audio should be muted
     *
     * @param $value
     * @return $this
     */
    public function muted($value)
    {
        $this->attrs()->set('muted', (bool) $value);
        return $this;
    }

    /**
     * Specifies if and how the author thinks the video should be loaded when the page loads.
     *
     * @param string $value
     *  auto|metadata|none
     * @return $this
     */
    public function preload(string $value)
    {
        $this->attrs()->set('preload', $value);
        return $this;
    }
}