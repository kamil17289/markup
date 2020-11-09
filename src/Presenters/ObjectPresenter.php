<?php

namespace Nethead\Markup\Presenters;

use Nethead\Markup\Tags\Tag;

/**
 * Class ObjectPresenter
 * @package Nethead\Markup\Presenters
 */
class ObjectPresenter implements PresenterInterface {
    /**
     * @param Tag $tag
     * @return Tag
     */
    public function present(Tag $tag)
    {
        return $tag;
    }
}