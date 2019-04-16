<?php

use \Nethead\Markup\Presenters\LaravelBladePresenter;
use \Nethead\Markup\Presenters\PlainStringPresenter;
use \Nethead\Markup\UrlGenerators\LaravelUrlAdapter;
use \Nethead\Markup\Presenters\ObjectPresenter;
use \Nethead\Markup\MarkupBuilder;
use \Orchestra\Testbench\TestCase;
use Illuminate\Support\HtmlString;
use Nethead\Markup\Html\Tag;

class MarkupBuilderTest extends TestCase {
    protected function getPackageProviders($app)
    {
        return ['Nethead\Markup\MarkupServiceProvider'];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Markup' => 'Nethead\Markup\MarkupFacade'
        ];
    }

    public function testCreatePlainStringPresenter()
    {
        $presenter = new PlainStringPresenter();

        $this->assertInstanceOf(PlainStringPresenter::class, $presenter);

        return $presenter;
    }

    public function testCreateObjectPresenter()
    {
        $presenter = new ObjectPresenter();

        $this->assertInstanceOf(ObjectPresenter::class, $presenter);

        return $presenter;
    }

    public function testCreateLaravelBladePresenter()
    {
        $presenter = new LaravelBladePresenter();

        $this->assertInstanceOf(LaravelBladePresenter::class, $presenter);

        return $presenter;
    }

    public function testCreateLaravelUrlAdapter()
    {
        $urlGenerator = $this->app->make(Illuminate\Contracts\Routing\UrlGenerator::class);

        $adapter = new LaravelUrlAdapter($urlGenerator);

        $this->assertInstanceOf(LaravelUrlAdapter::class, $adapter);

        return $adapter;
    }

    /**
     * @depends testCreatePlainStringPresenter
     * @depends testCreateLaravelUrlAdapter
     * @param $presenter
     * @param $adapter
     * @return MarkupBuilder
     */
    public function testCreateMarkupBuilderWithPlainStringPresenter($presenter, $adapter)
    {
        $builder = new MarkupBuilder($adapter, $presenter);

        $this->assertInstanceOf(MarkupBuilder::class, $builder);

        return $builder;
    }

    /**
     * @depends testCreateObjectPresenter
     * @depends testCreateLaravelUrlAdapter
     * @param $presenter
     * @param $adapter
     * @return MarkupBuilder
     */
    public function testCreateMarkupBuilderWithObjectPresenter($presenter, $adapter)
    {
        $builder = new MarkupBuilder($adapter, $presenter);

        $this->assertInstanceOf(MarkupBuilder::class, $builder);

        return $builder;
    }

    /**
     * @depends testCreateLaravelBladePresenter
     * @depends testCreateLaravelUrlAdapter
     * @param $presenter
     * @param $adapter
     * @return MarkupBuilder
     */
    public function testCreateMarkupBuilderWithBladePresenter($presenter, $adapter)
    {
        $builder = new MarkupBuilder($adapter, $presenter);

        $this->assertInstanceOf(MarkupBuilder::class, $builder);

        return $builder;
    }

    /**
     * @depends testCreateMarkupBuilderWithPlainStringPresenter
     */
    public function testMarkupBuilderWithPlainStringPresenter(MarkupBuilder $builder)
    {
        $this->assertIsString($builder->tag('br'));
    }

    /**
     * @depends testCreateMarkupBuilderWithObjectPresenter
     * @param MarkupBuilder $builder
     */
    public function testMarkupBuilderWithObjectPresenter(MarkupBuilder $builder)
    {
        $tag = $builder->tag('br');

        $this->assertInstanceOf(Tag::class, $tag);
        $this->assertIsString($tag->__toString());
    }

    /**
     * @depends testCreateMarkupBuilderWithBladePresenter
     * @param MarkupBuilder $builder
     */
    public function testMarkupBuilderWithBladePresenter(MarkupBuilder $builder)
    {
        $tag = $builder->tag('br');

        $this->assertInstanceOf(HtmlString::class, $tag);
        $this->assertIsString($tag->toHtml());
    }
}