<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

/**
 * Class Style
 * @package Nethead\Markup\Html
 */
class Style extends Tag {
    /**
     * Style constructor.
     * @param array $attributes
     * @param array $contents
     */
    public function __construct(array $attributes = [], array $contents = [])
    {
        parent::__construct('style', $attributes, $contents);
    }

    /**
     * @inheritdoc
     * @return array
     */
    public function getDefaultAttributes()
    {
        return [
            'type' => 'text/css',
            'media' => 'all'
        ];
    }

    /**
     * Set the devices for which this stylesheet should be used
     * @param $value
     * @return Style
     */
    public function media($value): Style
    {
        $this->attrs()->set('media', $value);

        return $this;
    }
}