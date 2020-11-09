<?php

namespace Nethead\Markup\Tags;

/**
 * Class Style
 * @package Nethead\Markup\Html
 */
class Style extends Tag {
    /**
     * Style constructor.
     * @param array $attributes
     * @param string $contents
     */
    public function __construct(array $attributes = [], $contents = '')
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
     * @return $this
     */
    public function media($value)
    {
        $this->setHtmlAttribute('media', $value);

        return $this;
    }
}