<?php

namespace Nethead\Markup;

use Illuminate\Support\Facades\Facade;

/**
 * Class MarkupFacade
 * @package Nethead\Markup
 */
class MarkupFacade extends Facade {
    /**
     * Get the registered name of the component.
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'markup';
    }
}