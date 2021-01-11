<?php

namespace Nethead\Markup\Foundation;

use Nethead\Markup\MarkupFactory;
use Nethead\Markup\Tags\Body;
use Nethead\Markup\Tags\Head;
use Nethead\Markup\Tags\Html;

/**
 * Creates a whole HTML document.
 * This class can be used for fast creation of simple pages, if the error occurs when
 * the templating engine is not loaded yet or just for convenient HTML building.
 * For example generating HTML reports or "fast 404" page.
 * @package Nethead\Markup\Foundation
 */
class Document {
    /**
     * Living standard
     *
     * @var string Doctype for HTML 5
     */
    const DOC_HTML5 = 'html';

    /**
     * Declaration for HTML 4.01 if you need to support something older
     *
     * @var string Doctype for HTML 4.01
     */
    const DOC_HTML4 = 'HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"';

    /**
     * Declaration for XHTML 1.1 if you need to parse it later as XML compliant
     *
     * @var string Doctype for XHTML 1.1
     */
    const DOC_XHTML = 'html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"';

    /**
     * Holds the doctype declaration for this document
     *
     * @var string Document type declaration
     */
    protected $doctype;

    /**
     * Root element of every HTML document
     *
     * @var Html Document main root, everyone knows what <html> is.
     */
    protected $html;

    /**
     * Document constructor.
     *
     * @param string $lang
     *  Language of the document. It will be inserted as the lang attribute in <html> element
     * @param array $attributes
     *  Other attributes you may need to put on <html> element
     * @param string $doctype
     *  HTML document version, defaults to HTML 5 (Document::DOC_HTML5).
     *  If you need to use custom doctype, omit the &lt;!DOCTYPE like this:
     *  new Document('en', [], 'HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"');
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
     *
     * @param string $documentType
     *  Contents for the &lt;!DOCTYPE&gt;
     *  Easier to use with defined constants, for example Document::DOC_HTML4
     * @return string
     */
    public function doctype(string $documentType) : string
    {
        return "<!DOCTYPE $documentType>";
    }

    /**
     * Get the head to set the metadata tags or attributes
     *
     * @see Head for more info on what you can do with your head
     * @return Head The instance of Head
     */
    public function head(): Head
    {
        return $this->html->children['head'];
    }

    /**
     * Give this document a title!
     *
     * @param string $title Title to show in the browser's window
     * @return Document Same document object, but with the title in the head
     */
    public function title(string $title): Document
    {
        $this->head()->addChildren([
            'title' => new Tag('title', [], [$title])
        ]);

        return $this;
    }

    /**
     * Add any meta tags to head element.
     *
     * @param string $name
     *  Meta tag name, like "keywords", "author", or "description"
     * @param string $value
     *  Value to set for the meta tag. Example: $document->meta('keywords', 'Nethead, Markup, HTML');
     * @return Document
     *  Same document, but with new meta data tags
     */
    public function meta(string $name, string $value): Document
    {
        $this->head()->addChildren([
            "meta-$name" => MarkupFactory::meta($name, $value)
        ]);

        return $this;
    }

    /**
     * Set the charset meta tag for this document.
     *
     * @param string $charset
     *  Pretty self-explanatory
     * @return Document
     *  Same document, but with new meta data tags
     */
    public function charset(string $charset = 'UTF-8'): Document
    {
        $this->head()->addChildren([
            'charset' => MarkupFactory::charset($charset)
        ]);

        return $this;
    }

    /**
     * Add more child elements to the head.
     * Warning: make sure that you didn't duplicated anything
     * @param array $contents
     * @return $this
     */
    public function toHead(array $contents): Document
    {
        $this->head()->addChildren($contents);

        return $this;
    }

    /**
     * Add more elements to the body
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
     * Compile the object into HTML string
     * @return string
     */
    public function __toString() : string
    {
        return $this->doctype . PHP_EOL . (string) $this->html;
    }
}