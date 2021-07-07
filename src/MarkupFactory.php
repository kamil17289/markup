<?php

namespace Nethead\Markup;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Tags\Fieldset;
use Nethead\Markup\Tags\Datalist;
use Nethead\Markup\Tags\Textarea;
use Nethead\Markup\Tags\Template;
use Nethead\Markup\Tags\Optgroup;
use Nethead\Markup\Tags\Picture;
use Nethead\Markup\Tags\Button;
use Nethead\Markup\Tags\Select;
use Nethead\Markup\Tags\Option;
use Nethead\Markup\Tags\Script;
use Nethead\Markup\Tags\Image;
use Nethead\Markup\Tags\Input;
use Nethead\Markup\Tags\Label;
use Nethead\Markup\Tags\Form;
use Nethead\Markup\Tags\Link;
use Nethead\Markup\Tags\Meta;
use Nethead\Markup\Tags\A;

class MarkupFactory {
    /**
     * Create <script> tag
     * @param string $src
     * @return Script
     */
    public static function script(string $src): Script
    {
        return new Script([
            'src' => $src
        ]);
    }

    /**
     * Create <link> to external CSS sheet
     * @param string $href
     * @param string $media
     * @return Link
     */
    public static function stylesheet(string $href, string $media = 'screen'): Link
    {
        return new Link([
            'rel' => 'stylesheet',
            'href' => $href,
            'media' => $media
        ]);
    }

    /**
     * Render alternative document versions in <link> element
     * @param string $href
     * @param string $type
     * @param string $title
     * @return Link
     */
    public static function alternate(string $href, string $type, string $title = ''): Link
    {
        $link = new Link([
            'rel' => 'alternate',
            'href' => $href,
            'type' => $type,
        ]);

        if (! empty($title)) {
            $link->attrs()->set('title', $title);
        }

        return $link;
    }

    /**
     * Render <link> element to document's author
     * @param string $href
     * @return Link
     */
    public static function authorLink(string $href): Link
    {
        return new Link([
            'rel' => 'author',
            'href' => $href
        ]);
    }

    /**
     * Render the favicon <link> element
     * @param string $href
     * @param string $type
     * @param string $sizes
     * @return Link
     */
    public static function icon(string $href, string $type, string $sizes): Link
    {
        return new Link([
            'rel' => 'icon',
            'href' => $href,
            'type' => $type,
            'sizes' => $sizes,
        ]);
    }

    /**
     * Create <img> element
     * @param string $src
     * @param string $alt
     * @return Image
     */
    public static function image(string $src, string $alt): Image
    {
        return new Image($src, $alt);
    }

    /**
     * Create a <picture> element
     * @param string $alt
     * @param array $attributes
     * @return Picture
     */
    public static function picture(string $alt, array $attributes = []): Picture
    {
        return new Picture($alt, $attributes);
    }

    /**
     * Create <a> element
     * @param string $href
     * @param array $contents
     * @return A
     */
    public static function anchor(string $href, array $contents): A
    {
        return new A($href, $contents);
    }

    /**
     * Create a bookmark.
     * @param string|Tag $to
     * @param array $contents What you want inside the link element.
     * @param array $attributes The HTML attributes for link element.
     *  What to bookmark - if string is provided it will be used as the bookmark destination.
     *  If $to is a Tag object it's ID will be fetched. If the object doesn't have the ID,
     *  it will be generated automatically
     *
     * @see MarkupFactory::generateId()
     * @return A
     */
    public static function bookmark($to, array $contents, array $attributes = []): A
    {
        return (new A('', $contents, $attributes))->bookmark($to);
    }

    /**
     * Create mailto: <a> element with obfuscated e-mail address
     * @param string $email
     * @param string $text
     * @return A
     */
    public static function mailto(string $email, string $text): A
    {
        return (new A($email, [$text]))->mailto();
    }

    /**
     * Create a charset <meta> element
     * @param string $charset
     * @return Tag
     */
    public static function charset(string $charset = 'UTF-8'): Tag
    {
        return new Tag('meta', ['charset' => $charset]);
    }

    /**
     * Create viewport <meta> element
     * @param string $deviceWidth
     * @param string $scale
     * @return Meta
     */
    public static function viewport(string $deviceWidth = 'device-width', string $scale = '1'): Meta
    {
        $content = sprintf('width=%s, initial-scale=%s'. $deviceWidth, $scale);

        return new Meta('viewport', $content);
    }

    /**
     * Create <meta> element
     * @param string $name author|description|keywords
     * @param string $content
     * @return Meta
     */
    public static function meta(string $name, string $content): Meta
    {
        return new Meta($name, $content);
    }

    /**
     * Create <input> button
     * @param string $name
     * @param string $value
     * @return Input
     */
    public static function inputButton(string $name, string $value): Input
    {
        return new Input('button', $name, $value);
    }

    /**
     * Create <button> element
     * @param string $value
     * @param array $contents
     * @return Button
     */
    public static function button(string $value, array $contents): Button
    {
        return new Button('button', $value, [], $contents);
    }

    /**
     * Create <input type="submit"> element
     * @param string $name
     * @param string $value
     * @return Input
     */
    public static function inputSubmit(string $name, string $value): Input
    {
        return new Input('submit', $name, $value);
    }

    /**
     * Create <button type="submit"> element
     * @param string $value
     * @param array $contents
     * @return Button
     */
    public static function submit(string $value, array $contents): Button
    {
        return new Button('submit', $value, [], $contents);
    }

    /**
     * Create <input type="reset"> element
     * @param string $name
     * @param string $value
     * @return Input
     */
    public static function inputReset(string $name, string $value): Input
    {
        return new Input('reset', $name, $value);
    }

    /**
     * Create <button type="reset"> element
     * @param string $value
     * @param array $contents
     * @return Button
     */
    public static function reset(string $value, array $contents): Button
    {
        return new Button('reset', $value, [], $contents);
    }

    /**
     * Create <datalist> element
     * @param string $id
     * @param array $options
     * @return Datalist
     */
    public static function dataList(string $id, array $options): Datalist
    {
        return new Datalist($id, [], $options);
    }

    /**
     * Create <optgroup> element
     * @param string $label
     * @param array $contents
     * @return Optgroup
     */
    public static function optGroup(string $label, array $contents): Optgroup
    {
        return new Optgroup($label, [], $contents);
    }

    /**
     * Create <option> element
     * @param string $value
     * @param string $label
     * @param bool $selected
     * @return Option
     */
    public static function option(string $value, string $label, bool $selected = false): Option
    {
        $option = new Option($value, $label);

        if ($selected) {
            $option->attrs()->set('selected', true);
        }

        return $option;
    }

    /**
     * Create new <select> element
     * @param string $name
     * @param array $options
     * @return Select
     */
    public static function select(string $name, array $options = []): Select
    {
        return new Select($name, $options);
    }

    /**
     * Create any <input> element
     * @param string $type
     * @param string $name
     * @param $value
     * @return Input
     */
    public static function input(string $type, string $name, $value): Input
    {
        return new Input($type, $name, $value);
    }

    /**
     * Create a radio/checkbox <input> element
     * @param string $type
     * @param string $name
     * @param $value
     * @param bool $checked
     * @return Input
     */
    public static function tickbox(string $type, string $name, $value, bool $checked = false): Input
    {
        $input = self::input($type, $name, $value);

        if ($checked) {
            $input->checked();
        }

        return $input;
    }

    /**
     * Create a checkbox <input> element
     * @param string $name
     * @param $value
     * @param bool $checked
     * @return Input
     */
    public static function checkbox(string $name, $value, bool $checked): Input
    {
        return self::tickbox('checkbox', $name, $value, $checked);
    }

    /**
     * Create a radio <input> element
     * @param string $name
     * @param $value
     * @param bool $checked
     * @return Input
     */
    public static function radio(string $name, $value, bool $checked): Input
    {
        return self::tickbox('radio', $name, $value, $checked);
    }

    /**
     * Create color <input> element
     * @param string $name
     * @param $value
     * @return Input
     */
    public static function color(string $name, $value): Input
    {
        return self::input('color', $name, $value);
    }

    /**
     * Create date <input> element
     * @param string $name
     * @param $value
     * @return Input
     */
    public static function date(string $name, $value): Input
    {
        return self::input('date', $name, $value);
    }

    /**
     * Create datetime-local <input> element
     * @param string $name
     * @param $value
     * @return Input
     */
    public static function datetimeLocal(string $name, $value): Input
    {
        return self::input('datetime-local', $name, $value);
    }

    /**
     * Create email <input> element
     * @param string $name
     * @param $value
     * @return Input
     */
    public static function email(string $name, $value): Input
    {
        return self::input('email', $name, $value);
    }

    /**
     * Create month <input> element
     * @param string $name
     * @param $value
     * @return Input
     */
    public static function month(string $name, $value): Input
    {
        return self::input('month', $name, $value);
    }

    /**
     * Create number/range <input> element
     * @param string $type
     * @param string $name
     * @param $value
     * @param int|null $min
     * @param int|null $max
     * @return Input
     */
    public static function limitedNumber(string $type, string $name, $value, int $min = null, int $max = null): Input
    {
        $input = self::input($type, $name, $value);

        if ($min) {
            $input->min($min);
        }

        if ($max) {
            $input->max($max);
        }

        return $input;
    }

    /**
     * Create number <input> element
     * @param string $name
     * @param null $value
     * @param int $step
     * @param int|null $min
     * @param int|null $max
     * @return mixed
     */
    public static function number(string $name, $value = null, int $step = 1, int $min = null, int $max = null): Input
    {
        $input = self::limitedNumber('number', $name, $value, $min, $max);

        $input->step($step);

        return $input;
    }

    /**
     * Create a range <input> element
     * @param string $name
     * @param $value
     * @param int|null $min
     * @param int|null $max
     * @return Input
     */
    public static function range(string $name, $value, int $min = null, int $max = null): Input
    {
        return self::limitedNumber('range', $name, $value, $min, $max);
    }

    /**
     * Create time <input> element
     * @param string $name
     * @param null $value
     * @param int|null $min
     * @param int|null $max
     * @return Input
     */
    public static function time(string $name, $value = null, int $min = null, int $max = null): Input
    {
        return self::limitedNumber('time', $name, $value, $min, $max);
    }

    /**
     * Create week <input> element
     * @param string $name
     * @param null $value
     * @param int|null $min
     * @param int|null $max
     * @return Input
     */
    public static function week(string $name, $value = null, int $min = null, int $max = null): Input
    {
        return self::limitedNumber('week', $name, $value, $min, $max);
    }

    /**
     * Create a password <input>
     * @param string $name
     * @return Input
     */
    public static function password(string $name): Input
    {
        return new Input('password', $name, null);
    }

    /**
     * Create a search <input>
     * @param string $name
     * @param string $value
     * @return Input
     */
    public static function search(string $name, string $value): Input
    {
        return new Input('search', $name, $value);
    }

    /**
     * Create a text <input>
     * @param string $name
     * @param string $value
     * @return Input
     */
    public static function text(string $name, string $value): Input
    {
        return new Input('text', $name, $value);
    }

    /**
     * Create a telephone <input>
     * @param string $name
     * @param string $value
     * @return Input
     */
    public static function tel(string $name, string $value): Input
    {
        return new Input('tel', $name, $value);
    }

    /**
     * Create a url <input>
     * @param string $name
     * @param string $value
     * @return Input
     */
    public static function url(string $name, string $value): Input
    {
        return new Input('url', $name, $value);
    }

    /**
     * Create file <input> element
     * @param string $name
     * @return Input
     */
    public static function file(string $name): Input
    {
        return self::input('file', $name, null);
    }

    /**
     * Create hidden <input> element
     * @param string $name
     * @param $value
     * @return Input
     */
    public static function hidden(string $name, $value): Input
    {
        return self::input('hidden', $name, $value);
    }

    /**
     * @param string $name
     * @param string $src
     * @param string $alt
     * @param null $value
     * @return Input
     */
    public static function imageSubmit(string $name, string $src, string $alt = '', $value = null): Input
    {
        $attributes['src'] = $src;

        if (! empty($alt)) {
            $attributes['alt'] = $alt;
        }

        return new Input('image', $name, $value, $attributes);
    }

    /**
     * Create <fieldset> element
     * @param array $contents
     * @param bool $disabled
     * @return Fieldset
     */
    public static function fieldset(array $contents, bool $disabled = false): Fieldset
    {
        $fieldset = new Fieldset([], $contents);

        if ($disabled) {
            $fieldset->disabled();
        }

        return $fieldset;
    }

    /**
     * Create a <textarea> element
     * @param string $name
     * @param array $contents
     * @param int $cols
     * @param int $rows
     * @return Textarea
     */
    public static function textarea(string $name, array $contents = [], int $cols = 40, int $rows = 5): Textarea
    {
        $textarea = new TextArea($name, [], $contents);

        $textarea
            ->cols($cols)
            ->rows($rows);

        return $textarea;
    }

    /**
     * Create <template> element
     * @param string $id
     * @param array $contents
     * @return Template
     */
    public static function template(string $id, array $contents = []): Template
    {
        return new Template($id, [], $contents);
    }

    /**
     * Create <label> element
     * @param string $for
     * @param string $text
     * @param Form|null $form
     * @return Label
     */
    public function label(string $for, string $text, Form $form = null): Label
    {
        $label =  new Label($for, $text);

        if ($form) {
            $label->bindForm($form);
        }

        return $label;
    }

    /**
     * Create the <form> element
     * @param string $action
     * @param string $method
     * @param array $contents
     * @param string $enctype
     * @return Form
     */
    public static function form(string $action, string $method, array $contents = [], string $enctype = Form::ENCTYPE_URLENCODED): Form
    {
        $form = new Form($action, $method, [], $contents);

        $form->enctype($enctype);

        return $form;
    }

    /**
     * Helper for creating ordered and unordered listings
     *
     * @param string $type
     *   Type of listing: 'ul' for unordered, 'ol' for ordered
     * @param array $points
     *   Array of points to be rendered inside a listing
     * @param callable|null $creator
     *   Creator function which can be used to create <li> elements.
     *   Should always return a Tag instance. Note: the contents won't be injected automatically!
     * @return Tag
     */
    public static function listing(string $type = 'ul', array $points, callable $creator = null): Tag
    {
        $contents = [];

        if (is_null($creator)) {
            foreach ($points as $point) {
                $contents[] = new Tag('li', [], [$point]);
            }
        }
        else {
            $contents = array_map($creator, $points);
        }

        return new Tag($type, [], $contents);
    }

    /**
     * @param int $length
     * @return string
     */
    public static function generateId(int $length = 5): string
    {
        return substr(md5(time()), 0, $length);
    }
}