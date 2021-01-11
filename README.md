# Nethead \ Markup

Markup is a package which let's you generate HTML code using objective PHP.
It can be used as a helper in Blade templates (Laravel), but it basically is 
created as a support package for my other projects.

The package is framework-independent. This means you can install it in every project
which is using Composer to manage its dependencies.

## Installation in Laravel
For Laravel, you only need to install it using composer. Markup supports package
discovery and automatically register itself in the service container under 'markup'
alias. You can also use the Markup Facade.

## Installation in other frameworks
First you need to create a Presenter. There are three presenters available for you out
of the box:

* LaravelBladePresenter - is used by the Laravel ServiceProvider so the MarkupBuilder
will always return a HtmlString object. You don't need to use it explicitly anywhere.
* ObjectPresenter - you can use it to make MarkupBuilder always return the Tag object,
instead of a `string`. You can then have more control and call any methods
delivered by the Tag objects.
* PlainStringPresenter - best for printing HTML inside templates, it will make the
MarkupBuilder return a compiled Tag in as a `string` type.

```
use Nethead\Markup\Presenters\PlainStringPresenter;

$presenter = new PlainStringPresenter();
```

Next you need a URL generator. Markup has two ready for use URL generators:
* LaravelUrlAdapter - is used automatically when you install a package in Laravel
* BasicUrlGenerator - is a simple URL generator which will simply create a URL based
on the current working domain. It is not recommended to use it - create your own 
URL generator by implementing the `Nethead\Markup\UrlGenerators\UrlGenerator`
interface to integrate the package with your framework.

```
use Nethead\Markup\UrlGenerators\BasicUrlGenerator;

$generator = new BasicUrlGenerator();
```

Next create an MarkupBuilder instance configuring it with the appropriate URL generator
and presenter:

```
use Nethead\Markup\MarkupBuilder;

$htmlBuilder = new MarkupBuilder($generator, $presenter);
```

You can register it as a service or construct a factory function, or do whatever your
framework supports to integrate the package.

## Generating HTML code
```
$htmlBuilder->doctype();
$htmlBuilder->tag(string $name, array $attributes = [], $contents = '');
$htmlBuilder->script(string $assetPath = '', array $attributes = [], $secure = null);
$htmlBuilder->style(array $attributes = [], $contents = '');
$htmlBuilder->link(array $attributes = []);
$htmlBuilder->stylesheet(string $href, string $media, array $attributes = []);
$htmlBuilder->alternate(string $href, string $type, string $title = '', array $attributes = []);
$htmlBuilder->author(string $href, array $attributes = []);
$htmlBuilder->icon(string $href, string $type, string $sizes, array $attributes = []);
$htmlBuilder->image(string $src, string $alt, array $attributes = []);
$htmlBuilder->picture(string $alt, array $attributes = [], $secure = null);
$htmlBuilder->a(string $href, string $text, array $attributes = []);
$htmlBuilder->mailto(string $email, string $text, array $attributes = []);
$htmlBuilder->meta(string $name, string $content);
$htmlBuilder->charset($charset = 'UTF-8');
$htmlBuilder->viewport(string $content = 'width=device-width, initial-scale=1.0');
$htmlBuilder->meta_author(string $content);
$htmlBuilder->meta_description(string $content);
$htmlBuilder->meta_keywords(string $content);
```