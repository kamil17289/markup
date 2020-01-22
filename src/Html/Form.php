<?php

namespace Nethead\Markup\Html;

class Form extends Tag {
    /**
     * Form encoding types (only for POST method)
     */
    const ENCTYPE_URLENCODED = 'application/x-www-form-urlencoded';
    const ENCTYPE_MULTIPART = 'multipart/form-data';
    const ENCTYPE_TEXTPLAIN = 'text/plain';

    /**
     * @var string
     */
    public $enctype = 'application/x-www-form-urlencoded';

    /**
     * Form constructor.
     * @param string $action
     * @param string $method
     * @param array $attributes
     * @param string $contents
     */
    public function __construct(string $action, string $method = 'post', array $attributes = [], $contents = '')
    {
        parent::__construct('form', $attributes, $contents);

        $this->setHtmlAttribute('action', $action);
        $this->setHtmlAttribute('method', $method);
    }

    /**
     * @param string $charset
     * @return $this
     */
    public function acceptCharset(string $charset)
    {
        $this->appendToAttribute('accept-charset', $charset, ' ');

        return $this;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function autocomplete(bool $value = true)
    {
        $autocomplete = $value ? 'on' : 'off';

        $this->setHtmlAttribute('autocomplete', $autocomplete);

        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function name(string $name)
    {
        $this->setHtmlAttribute('name', $name);

        return $this;
    }
}