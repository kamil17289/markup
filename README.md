# Nethead \ Markup

Markup is a package which let's you generate HTML code using objective PHP.
It can be used as a helper in Blade templates (Laravel), but it basically is 
created as a support package for my other projects.

The package is framework-independent. This means you can install it in every project
which is using PSR-4 autoloading.

## Usage
Use Nethead\Markup\MarkupFactory to build object representation of the
needed HTML. Use can generate menus, links, blocks, paragraphs, anything.
MarkupFactory includes useful static helpers to quickly generate what you
want. The package also includes a `tag` helper function if you like the
functional approach more.

## Generating HTML code
```php
use Nethead\Markup\MarkupFactory as Html;
// or
use function Nethead\Markup\Helpers\tag;

// Link to Google.com
Html::anchor('https://google.com', ['Go to Google'])->blank();

// Image link
Html::anchor('https://google.com', [
    Html::image('/img/google.png', 'Google Logo')
])->blank();

// Paragraph
tag('p', ['class' => 'px-2'], [
    'Here is how you can search with',
    tag('a', ['href' => 'https://google.com'], ['Google'])->blank()
]);
```

Markup objects are designed to support methods chaining, with 
self-explanatory syntax, and ability to pass them through the chain of
execution. It makes it easy to make changes to the markup with 
comfortable objective API, instead of operating on strings or arrays.
This is useful for example when you have multiple modules, each altering
or adding something to the HTML.

## Using HtmlAttributes
Each Markup object has a public attrs() method which returns the
HtmlAttributes object, which in turn allows you to set, remove or modify
the attributes of an HTML element.

```php
$menuItem = tag('li', ['class' => 'nav-item'], ['Discount!']);
// (...)
$menuItem->attrs()
    ->set('class', 'bold');
```

## Using ClassList object
Each Markup object is also allowing you to set and remove CSS classes
without calling the attr() object. You can access the ClassList object
directly with classList() public method:

```php
if ($menuItem->classList()->caintains('bold')) {
    $menuItem->attrs()->data('modal', 'discount');
}
```

## Configuring the package
Using the HtmlConfig you can easily change how the HTML is generated.
For example, if you like to have void tags (like input) closed everytime,
just call this before you start creating:

```php
use Nethead\Markup\Helpers\HtmlConfig;

HtmlConfig::$closeVoids = true;
```
Refer to the documentation to have a better insight of what can be
configured and how.

## Icons Factory
The IconsFactory makes it easy to switch between the icon fonts providers.
By default, it is configured to generate Font Awesome HTML tags.
For example, if you're using the Bootstrap's Glyphicons, you could do:

```php
use Nethead\Markup\Helpers\IconsFactory;
use Nethead\Markup\Helpers\HtmlConfig;

HtmlConfig::$defaultIconsFactory = 'glyphicons';

print IconsFactory::icon('user');
```

## Forms
You can build HTML forms using OOP PHP and easily add business logic.
Look at the example below to see how easy it is to build a language
select dropdown menu:

```php
use Nethead\Markup\MarkupFactory as Html;

$langs = [
    'en_GB' => 'English (British)',
    'pl_PL' => 'Polski'
];

$select = Html::select('locale', $langs);
$select->attrs()
    ->on('change', 'this.form.submit();');

$form = Html::form('/select-locale', 'POST', [$select]);
```