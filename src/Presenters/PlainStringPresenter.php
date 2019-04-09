<?php

namespace Nethead\Markup\Presenters;

use Nethead\Markup\Html\Tag;

/**
 * Class PlainStringPresenter
 * @package Nethead\Markup\Presenters
 */
class PlainStringPresenter implements PresenterInterface {
    /**
     * @param Tag $tag
     * @return string
     */
    public function present(Tag $tag)
    {
        return (string) $tag;
    }
}