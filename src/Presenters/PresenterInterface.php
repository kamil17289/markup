<?php

namespace Nethead\Markup\Presenters;

use Nethead\Markup\Tags\Tag;

/**
 * Interface PresenterInterface
 * @package Nethead\Html\Presenters
 */
interface PresenterInterface {
    /**
     * @param Tag $tag
     * @return mixed
     */
    public function present(Tag $tag);
}