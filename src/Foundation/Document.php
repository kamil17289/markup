<?php

namespace Nethead\Markup\Foundation;

use Nethead\Markup\Tags\Body;
use Nethead\Markup\Tags\Head;

class Document {
    /**
     * Living standard
     */
    const DOC_HTML5 = 'html';

    /**
     * Declaration for HTML 4.01 if you need to suppoer something older
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
     * @var Tags\Html Document main root
     */
    protected $html;

    /**
     * @var MarkupBuilder Builder object for generating new nodes
     */
    protected $builder;

    /**
     * Document constructor.
     * @param MarkupBuilder $builder
     * @param string $lang
     * @param string $doctype
     */
    public function __construct(MarkupBuilder $builder, string $lang, array $attributes = [], $doctype = self::DOC_HTML5)
    {
        $this->builder = $builder;

        $this->doctype = $this->builder->doctype($doctype);

        $this->html = new Tags\Html($lang, $attributes, [
            new Head(),
            new Body()
        ]);
    }

    /**
     * Get the head to set the metadata tags or attributes
     * @return mixed
     */
    public function head()
    {
        return $this->html->contents[1];
    }

    /**
     * Get the body to set attributes or contents
     * @return mixed
     */
    public function body()
    {
        return $this->html->contents[0];
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->doctype . PHP_EOL . (string) $this->html;
    }
}