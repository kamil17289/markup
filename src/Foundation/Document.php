<?php

namespace Nethead\Markup\Foundation;

use Nethead\Markup\MarkupFactory;
use Nethead\Markup\Tags\Body;
use Nethead\Markup\Tags\Head;
use Nethead\Markup\Tags\Html;

class Document {
    /**
     * Living standard
     */
    const DOC_HTML5 = 'html';

    /**
     * Declaration for HTML 4.01 if you need to support something older
     */
    const DOC_HTML4 = 'HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"';

    /**
     * Declaration for XHTML 1.1 if you need to parse it later as XML compliant
     */
    const DOC_XHTML = 'html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"';

    /**
     * @var string Document type declaration
     */
    protected $doctype;

    /**
     * @var Html Document main root
     */
    protected $html;

    /**
     * Document constructor.
     * @param string $lang
     * @param array $attributes
     * @param string $doctype
     */
    public function __construct(string $lang, array $attributes = [], $doctype = self::DOC_HTML5)
    {
        $this->doctype = $this->doctype($doctype);

        $this->html = new Html($lang, $attributes, [
            'head' => new Head(),
            'body' => new Body()
        ]);
    }

    /**
     * Return document type declaration as string
     * @param string $documentType
     * @return string
     */
    public function doctype(string $documentType) : string
    {
        return "<!DOCTYPE $documentType>";
    }

    /**
     * Get the head to set the metadata tags or attributes
     * @return Head
     */
    public function head(): Head
    {
        return $this->html->children['head'];
    }

    /**
     * @param string $title
     * @return Document
     */
    public function title(string $title): Document
    {
        $this->head()->addChildren([
            'title' => new Tag('title', [], [$title])
        ]);

        return $this;
    }

    /**
     * @param string $name
     * @param string $value
     * @return Document
     */
    public function meta(string $name, string $value): Document
    {
        $this->head()->addChildren([
            "meta-$name" => MarkupFactory::meta($name, $value)
        ]);

        return $this;
    }

    /**
     * @param string $charset
     * @return Document
     */
    public function charset(string $charset = 'UTF-8'): Document
    {
        $this->head()->addChildren([
            'charset' => MarkupFactory::charset($charset)
        ]);

        return $this;
    }

    /**
     * @param array $contents
     * @return $this
     */
    public function toHead(array $contents): Document
    {
        $this->head()->addChildren($contents);

        return $this;
    }

    /**
     * @param array $contents
     * @return $this
     */
    public function toBody(array $contents): Document
    {
        $this->body()->addChildren($contents);

        return $this;
    }

    /**
     * Get the body to set attributes or contents
     * @return Body
     */
    public function body(): Body
    {
        return $this->html->children['body'];
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->doctype . PHP_EOL . (string) $this->html;
    }
}