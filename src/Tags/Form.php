<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Helpers\CanBeAutoCompleted;

/**
 * Creates a "form" element.
 *
 * @package Nethead\Markup\Tags
 */
class Form extends Tag {
    use CanBeAutoCompleted;

    /**
     * Form encoding types (only for POST method).
     * Use for POST forms without binary data. The keys and values are encoded in key-value tuples
     * separated by '&', with a '=' between the key and the value. Non-alphanumeric characters in both
     * keys and values are percent encoded.
     *
     * @var string
     */
    const ENCTYPE_URLENCODED = 'application/x-www-form-urlencoded';

    /**
     * Each value is sent as a block of data ("body part"), with a user agent-defined delimiter ("boundary")
     * separating each part. This one is good for binary data forms.
     *
     * @var string
     */
    const ENCTYPE_MULTIPART = 'multipart/form-data';

    /**
     * Plain text - no encoding, introduced for debugging purposes
     *
     * @var string
     */
    const ENCTYPE_TEXTPLAIN = 'text/plain';

    /**
     * Current form encoding.
     *
     * @var string
     */
    public $enctype = 'application/x-www-form-urlencoded';

    /**
     * Form constructor.
     *
     * @param string $action
     *  The URL where the data is going to be sent.
     * @param string $method
     *  HTTP method for sending the data: GET|POST
     * @param array $children
     *  Child elements that will be put inside (images, texts, whatever)
     * @param array $attributes
     *  Additional HTML attributes you want to add
     */
    public function __construct(string $action, string $method = 'post', array $attributes = [], array $children = [])
    {
        if (! isset($attributes['id'])) {
            $attributes['id'] = substr(md5(time()), 0, 6);
        }

        if (! empty($children)) {
            foreach($children as $name => $element) {
                if (method_exists($element, 'bindForm')) {
                    $element->bindForm($this);
                }
            }
        }

        parent::__construct('form', $attributes, $children);

        $this->attrs()->set('action', $action);
        $this->attrs()->set('method', $method);
    }

    /**
     * Set the accept-charset attribute.
     *
     * @param string $charset The charset accepted by the form inputs
     * @return Form
     */
    public function acceptCharset(string $charset): Form
    {
        $this->attrs()->set('accept-charset', $charset);

        return $this;
    }

    /**
     * Set the enctype attribute.
     *
     * @param string $enctype
     * @return Form
     */
    public function enctype(string $enctype): Form
    {
        $this->attrs()->set('enctype', $enctype);

        return $this;
    }

    /**
     * Set the form element name attribute.
     *
     * @param string $name Name for this form
     * @return Form
     */
    public function name(string $name): Form
    {
        $this->attrs()->set('name', $name);

        return $this;
    }
}