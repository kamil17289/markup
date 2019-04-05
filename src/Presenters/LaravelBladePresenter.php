<?php

namespace Nethead\Markup\Presenters;

use Illuminate\Support\HtmlString;
use Nethead\Markup\Html\Tag;

/**
 * Class LaravelBladePresenter
 * @package Nethead\Markup\Presenters
 */
class LaravelBladePresenter implements PresenterInterface {
    /**
     * @param Tag $tag
     * @return \Illuminate\Support\HtmlString
     */
    public function present(Tag $tag)
    {
        return new HtmlString((string) $tag);
    }
}