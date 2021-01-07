<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;

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
     * @param array $contents
     */
    public function __construct(string $action, string $method = 'post', array $attributes = [], array $contents = [])
    {
        if (! isset($attributes['id'])) {
            $attributes['id'] = substr(md5(time()), 0, 6);
        }

        if (! empty($contents)) {
            foreach($contents as $name => $element) {
                if (method_exists($element, 'bindForm')) {
                    $element->bindForm($this);
                }
            }
        }

        parent::__construct('form', $attributes, $contents);

        $this->attrs()->set('action', $action);
        $this->attrs()->set('method', $method);
    }

    /**
     * @param string $charset
     * @return $this
     */
    public function acceptCharset(string $charset)
    {
        $this->attrs()->set('accept-charset', $charset);

        return $this;
    }

    /**
     * @param string $enctype
     * @return $this
     */
    public function enctype(string $enctype)
    {
        $this->attrs()->set('enctype', $enctype);

        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function autocomplete($value = true)
    {
        $autocomplete = $value ? 'on' : 'off';

        $this->attrs()->set('autocomplete', $autocomplete);

        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function name(string $name)
    {
        $this->attrs()->set('name', $name);

        return $this;
    }
}