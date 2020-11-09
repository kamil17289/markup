<?php

namespace Nethead\Markup;

use Nethead\Markup\Presenters\PresenterInterface;
use Nethead\Markup\Tags\Datalist;
use Nethead\Markup\Tags\Fieldset;
use Nethead\Markup\Tags\Optgroup;
use Nethead\Markup\Tags\Template;
use Nethead\Markup\Tags\Textarea;
use Nethead\Markup\Tags\Picture;
use Nethead\Markup\Tags\Button;
use Nethead\Markup\Tags\Legend;
use Nethead\Markup\Tags\Option;
use Nethead\Markup\Tags\Mailto;
use Nethead\Markup\Tags\Script;
use Nethead\Markup\Tags\Select;
use Nethead\Markup\Tags\Input;
use Nethead\Markup\Tags\Label;
use Nethead\Markup\Tags\Image;
use Nethead\Markup\Tags\Style;
use Nethead\Markup\Tags\Link;
use Nethead\Markup\Tags\Meta;
use Nethead\Markup\Tags\Form;
use Nethead\Markup\Tags\Tag;
use Nethead\Markup\Tags\A;

/**
 * Class MarkupBuilder
 * @package Nethead\Markup
 */
class MarkupBuilder {
    /**
     * \Nethead\Markup\Presenters\PresenterInterface
     * @var
     */
    protected $presenter;

    /**
     * MarkupBuilder constructor.
     * @param PresenterInterface $presenter
     */
    public function __construct(PresenterInterface $presenter)
    {
        $this->presenter = $presenter;
    }

    /**
     * @param Tag $tag
     * @return mixed
     */
    protected function present(Tag $tag)
    {
        return $this->presenter->present($tag);
    }

    /**
     * Get HTML5 doctype declaration (only version 5 is supported)
     * @param string $declaration
     * @return string
     */
    public function doctype($declaration = Document::DOC_HTML5) : string
    {
        return "<!DOCTYPE $declaration>";
    }

    /**
     * Render a tag, whatever you like
     * @param string $name
     * @param array $attributes
     * @param string $contents
     * @return mixed
     */
    public function tag(string $name, array $attributes = [], $contents = '')
    {
        return $this->present(new Tag($name, $attributes, $contents));
    }

    /**
     * Render <script>
     * @param string $src
     * @param array $attributes
     * @return mixed
     */
    public function script(string $src = '', array $attributes = [])
    {
        if (! empty($src)) {
            $attributes['src'] = $src;
        }

        return $this->present(new Script($attributes));
    }

    /**
     * Render <style>
     * @param array $attributes
     * @param string $contents
     * @return mixed
     */
    public function style(array $attributes = [], $contents = '')
    {
        return $this->present(new Style($attributes, $contents));
    }

    /**
     * Render <link> element
     * @param array $attributes
     * @return mixed
     */
    public function link(array $attributes = [])
    {
        return $this->present(new Link($attributes));
    }

    /**
     * Render <link> to external CSS sheet
     * @param string $href
     * @param string $media
     * @param array $attributes
     * @return mixed
     */
    public function stylesheet(string $href, string $media, array $attributes = [])
    {
        $attributes['rel'] = 'stylesheet';
        $attributes['media'] = $media;
        $attributes['href'] = $href;

        return $this->present(new Link($attributes));
    }

    /**
     * Render alternative document versions in <link> element
     * @param string $href
     * @param string $type
     * @param string $title
     * @param array $attributes
     * @return mixed
     */
    public function alternate(string $href, string $type, string $title = '', array $attributes = [])
    {
        $attributes = array_merge($attributes, [
            'href' => $href,
            'type' => $type,
            'rel' => 'alternate'
        ]);

        if (! empty($title)) {
            $attributes['title'] = $title;
        }

        return $this->present(new Link($attributes));
    }

    /**
     * Render <link> element to document's author
     * @param $href
     * @param array $attributes
     * @return mixed
     */
    public function author(string $href, array $attributes = [])
    {
        $attributes = array_merge($attributes, [
            'rel' => 'author',
            'href' => $href
        ]);

        return $this->present(new Link($attributes));
    }

    /**
     * Render the favicon <link> element
     * @param string $href
     * @param string $type
     * @param string $sizes
     * @param array $attributes
     * @return mixed
     */
    public function icon(string $href, string $type, string $sizes, array $attributes = [])
    {
        $attributes = array_merge($attributes, [
            'href' => $href,
            'type' => $type,
            'sizes' => $sizes,
            'rel' => 'icon'
        ]);

        return $this->present(new Link($attributes));
    }

    /**
     * Render <img> element
     * @param string $src
     * @param string $alt
     * @param array $attributes
     * @return mixed
     */
    public function image(string $src, string $alt, array $attributes = [])
    {
        return $this->present(new Image($src, $alt, $attributes));
    }

    /**
     * Render a <picture> element
     * @param string $alt
     * @param array $attributes
     * @return mixed
     */
    public function picture(string $alt, array $attributes = [])
    {
        return $this->present(new Picture($alt, $attributes));
    }

    /**
     * Render <a> element
     * @param string $href
     * @param string $text
     * @param array $attributes
     * @return mixed
     */
    public function a(string $href, string $text, array $attributes = [])
    {
        return $this->present(new A($href, $text, $attributes));
    }

    /**
     * Render obfuscated mailto: <a> element
     * @param string $email
     * @param string $text
     * @param array $attributes
     * @return mixed
     */
    public function mailto(string $email, string $text, array $attributes = [])
    {
        return $this->present(new Mailto($email, $text, $attributes));
    }

    /**
     * Render custom <meta> element
     * @param string $name
     * @param string $content
     * @return mixed
     */
    public function meta(string $name, string $content)
    {
        return $this->present(new Meta($name, $content));
    }

    /**
     * Render charset <meta> element
     * @param string $charset
     * @return string
     */
    public function charset($charset = 'UTF-8')
    {
        return Meta::charset($charset);
    }

    /**
     * Render viewport <meta> element
     * @param string $content
     * @return mixed
     */
    public function viewport(string $content = 'width=device-width, initial-scale=1.0')
    {
        return $this->meta('viewport', $content);
    }

    /**
     * Render author <meta> element
     * @param string $content
     * @return Meta
     */
    public function meta_author(string $content)
    {
        return $this->meta('author', $content);
    }

    /**
     * Render description <meta> element
     * @param string $content
     * @return Meta
     */
    public function meta_description(string $content)
    {
        return $this->meta('description', $content);
    }

    /**
     * Render keywords <meta> element
     * @param string $content
     * @return Meta
     */
    public function meta_keywords(string $content)
    {
        return $this->meta('keywords', $content);
    }

    /**
     * @param string $name
     * @param string $value
     * @param string $text
     * @param array $attributes
     * @param bool $useInput
     * @return mixed
     */
    public function button(string $name, string $text, string $value = '', array $attributes = [], bool $useInput = false)
    {
        if ($useInput) {
            return $this->present(
                new Input('button', $name, $text, $attributes)
            );
        }

        return $this->present(new Button('button', $value, $attributes, $text));
    }

    /**
     * @param string $name
     * @param string $value
     * @param array $attributes
     * @param bool $useInput
     * @param string $contents
     * @return mixed
     */
    public function submit(string $name, string $value, array $attributes = [], bool $useInput = false, $contents = '')
    {
        if ($useInput) {
            return $this->present(
                new Input('submit', $name, $value, $attributes)
            );
        }

        return $this->present(
            new Button('submit', $value, $attributes, $contents)
        );
    }

    /**
     * @param string $name
     * @param string $value
     * @param array $attributes
     * @param bool $useInput
     * @param string $contents
     * @return mixed
     */
    public function reset(string $name, string $value, array $attributes = [], bool $useInput = false, $contents = '')
    {
        if ($useInput) {
            return $this->present(
                new Input('reset', $name, $value, $attributes)
            );
        }

        return $this->present(
            new Button('reset', $value, $attributes, $contents)
        );
    }

    /**
     * @param string $id
     * @param array $options
     * @param array $attributes
     * @return mixed
     */
    public function datalist(string $id, array $options, array $attributes = [])
    {
        return $this->present(
            new Datalist($id, $attributes, $options)
        );
    }

    /**
     * @param string $label
     * @param array $contents
     * @param array $attributes
     * @return mixed
     */
    public function optgroup(string $label, array $contents, array $attributes = [])
    {
        return $this->present(
            new Optgroup($label, $attributes, $contents)
        );
    }

    /**
     * @param string $value
     * @param string $text
     * @param bool $selected
     * @param array $attributes
     * @return mixed
     */
    public function option(string $value, string $text, bool $selected = false, array $attributes = [])
    {
        $option = new Option($value, $text, $attributes);

        if ($selected) {
            $option->setHtmlAttribute('selected', true);
        }

        return $this->present($option);
    }

    /**
     * @param string $name
     * @param array $options
     * @param array $attributes
     * @return mixed
     */
    public function select(string $name, array $options = [], array $attributes = [])
    {
        return $this->present(
            new Select($name, $options, $attributes)
        );
    }

    /**
     * @param string $type
     * @param string $name
     * @param $value
     * @param array $attributes
     * @return mixed
     */
    public function input(string $type, string $name, $value, array $attributes = [])
    {
        return $this->present(
            new Input($type, $name, $value, $attributes)
        );
    }

    /**
     * @param string $name
     * @param $value
     * @param bool $checked
     * @param array $attributes
     * @return mixed
     */
    public function checkbox(string $name, $value, bool $checked = false, array $attributes = [])
    {
        $input = new Input('checkbox', $name, $value, $attributes);

        if ($checked) {
            $input->checked();
        }

        return $this->present($input);
    }

    /**
     * @param string $name
     * @param $value
     * @param bool $checked
     * @param array $attributes
     * @return mixed
     */
    public function radio(string $name, $value, bool $checked = false, array $attributes = [])
    {
        $radio = new Input('radio', $name, $value, $attributes);

        if ($checked) {
            $radio->checked();
        }

        return $this->present($radio);
    }

    /**
     * @param string $name
     * @param $value
     * @param array $attributes
     * @return mixed
     */
    public function color(string $name, $value = null, array $attributes = [])
    {
        return $this->present(
            new Input('color', $name, $value, $attributes)
        );
    }

    /**
     * @param string $name
     * @param $value
     * @param array $attributes
     * @return mixed
     */
    public function date(string $name, $value = null, array $attributes = [])
    {
        return $this->present(
            new Input('date', $name, $value, $attributes)
        );
    }

    /**
     * @param string $name
     * @param $value
     * @param array $attributes
     * @return mixed
     */
    public function datetimeLocal(string $name, $value = null, array $attributes = [])
    {
        return $this->present(
            new Input('datetime-local', $name, $value, $attributes)
        );
    }

    /**
     * @param string $name
     * @param $value
     * @param array $attributes
     * @return mixed
     */
    public function email(string $name, $value = null, array $attributes = [])
    {
        return $this->present(
            new Input('email', $name, $value, $attributes)
        );
    }

    /**
     * @param string $name
     * @param array $attributes
     * @return mixed
     */
    public function file(string $name, array $attributes = [])
    {
        return $this->present(
            new Input('file', $name, null, $attributes)
        );
    }

    /**
     * @param string $name
     * @param $value
     * @param array $attributes
     * @return mixed
     */
    public function hidden(string $name, $value, array $attributes = [])
    {
        return $this->present(
            new Input('hidden', $name, $value, $attributes)
        );
    }

    /**
     * @param string $name
     * @param string $src
     * @param string $alt
     * @param null $value
     * @param array $attributes
     * @return mixed
     */
    public function imageSubmit(string $name, string $src, string $alt = '', $value = null, array $attributes = [])
    {
        $attributes['src'] = $src;

        if (! empty($alt)) {
            $attributes['alt'] = $alt;
        }

        return $this->present(
            new Input('image', $name, $value, $attributes)
        );
    }

    /**
     * @param string $name
     * @param $value
     * @param array $attributes
     * @return mixed
     */
    public function month(string $name, $value, array $attributes = [])
    {
        return $this->present(
            new Input('month', $name, $value, $attributes)
        );
    }

    /**
     * @param string $name
     * @param null $value
     * @param int $step
     * @param int|null $min
     * @param int|null $max
     * @param array $attributes
     * @return mixed
     */
    public function number(string $name, $value = null, int $step = 1, int $min = null, int $max = null, array $attributes = [])
    {
        $input = new Input('number', $name, $value, $attributes);

        if ($min) {
            $input->min($min);
        }

        if ($max) {
            $input->max($max);
        }

        $input->step($step);

        return $this->present($input);
    }

    /**
     * @param string $name
     * @param null $value
     * @param int|null $min
     * @param int|null $max
     * @param array $attributes
     * @return mixed
     */
    public function range(string $name, $value = null, int $min = null, int $max = null, array $attributes = [])
    {
        $input = new Input('range', $name, $value, $attributes);

        if ($min) {
            $input->min($min);
        }

        if ($max) {
            $input->max($max);
        }

        return $this->present($input);
    }

    /**
     * @param string $name
     * @param null $value
     * @param int|null $min
     * @param int|null $max
     * @param array $attributes
     * @return mixed
     */
    public function time(string $name, $value = null, int $min = null, int $max = null, array $attributes = [])
    {
        $input = new Input('time', $name, $value, $attributes);

        if ($min) {
            $input->min($min);
        }

        if ($max) {
            $input->max($max);
        }

        return $this->present($input);
    }

    /**
     * @param string $name
     * @param null $value
     * @param int|null $min
     * @param int|null $max
     * @param array $attributes
     * @return mixed
     */
    public function week(string $name, $value = null, int $min = null, int $max = null, array $attributes = [])
    {
        $input = new Input('week', $name, $value, $attributes);

        if ($min) {
            $input->min($min);
        }

        if ($max) {
            $input->max($max);
        }

        return $this->present($input);
    }

    /**
     * @param string $name
     * @param array $attributes
     * @return mixed
     */
    public function password(string $name, array $attributes = [])
    {
        return $this->present(
            new Input('password', $name, null, $attributes)
        );
    }

    /**
     * @param string $name
     * @param $value
     * @param array $attributes
     * @return mixed
     */
    public function search(string $name, $value, array $attributes = [])
    {
        return $this->present(
            new Input('search', $name, $value, $attributes)
        );
    }

    /**
     * @param string $name
     * @param $value
     * @param array $attributes
     * @return mixed
     */
    public function text(string $name, $value, array $attributes = [])
    {
        return $this->present(
            new Input('text', $name, $value, $attributes)
        );
    }

    /**
     * @param string $name
     * @param $value
     * @param array $attributes
     * @return mixed
     */
    public function tel(string $name, $value, array $attributes = [])
    {
        return $this->present(
            new Input('tel', $name, $value, $attributes)
        );
    }

    /**
     * @param string $name
     * @param $value
     * @param array $attributes
     * @return mixed
     */
    public function url(string $name, $value, array $attributes = [])
    {
        return $this->present(
            new Input('url', $name, $value, $attributes)
        );
    }

    /**
     * @param array $contents
     * @param array $attributes
     * @param bool $disabled
     * @return mixed
     */
    public function fieldset(array $contents = [], array $attributes = [], bool $disabled = false)
    {
        $fieldset = new Fieldset($attributes, $contents);

        if ($disabled) {
            $fieldset->disabled();
        }

        return $this->present($fieldset);
    }

    /**
     * @param string $name
     * @param string $contents
     * @param int $cols
     * @param int $rows
     * @param array $attributes
     * @return mixed
     */
    public function textarea(string $name, $contents = '', int $cols = 40, int $rows = 5, array $attributes = [])
    {
        $textarea = new Textarea($name, $attributes, $contents);

        $textarea->cols($cols);
        $textarea->rows($rows);

        return $this->present($textarea);
    }

    /**
     * @param string $id
     * @param string $contents
     * @param array $attributes
     * @return mixed
     */
    public function template(string $id, $contents = '', array $attributes = [])
    {
        return $this->present(new Template($id, $attributes, $contents));
    }

    /**
     * @param string $for
     * @param string $text
     * @param array $attributes
     * @param string $form
     * @return mixed
     */
    public function label(string $for, string $text, array $attributes = [], string $form = '')
    {
        return $this->present(new Label($for, $text, $attributes, $form));
    }

    /**
     * @param string $text
     * @param array $attributes
     * @return mixed
     */
    public function legend(string $text, array $attributes = [])
    {
        return $this->present(new Legend($text, $attributes));
    }

    /**
     * @param string $action
     * @param string $method
     * @param string $contents
     * @param string $enctype
     * @param array $attributes
     * @return mixed
     */
    public function form(string $action, string $method, $contents = '', $enctype = Form::ENCTYPE_URLENCODED, array $attributes = [])
    {
        $form = new Form($action, $method, $attributes, $contents);

        $form->enctype($enctype);

        return $this->present($form);
    }
}