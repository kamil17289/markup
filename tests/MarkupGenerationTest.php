<?php

use Nethead\Markup\MarkupBuilder;
use \Orchestra\Testbench\TestCase;
use Nethead\Markup\UrlGenerators\LaravelUrlAdapter;
use \Nethead\Markup\Presenters\PlainStringPresenter;

class MarkupGenerationTest extends TestCase {
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

    public function testCreateMarkupBuilder()
    {
        $presenter = new PlainStringPresenter();

        $urlGenerator = $this->app->make(Illuminate\Contracts\Routing\UrlGenerator::class);

        $adapter = new LaravelUrlAdapter($urlGenerator);

        $builder = new MarkupBuilder($adapter, $presenter);

        $this->assertInstanceOf(MarkupBuilder::class, $builder);

        return $builder;
    }

    /**
     * @depends testCreateMarkupBuilder
     * @param MarkupBuilder $builder
     */
    public function testMarkupGeneration(MarkupBuilder $builder)
    {
        $html5doctype = '<!DOCTYPE html>';
        $link = '<a href="http://google.com" target="_blank" class="btn btn-primary">Go to Google</a>';

        $doctypeTest = $builder->doctype();
        $this->assertEquals($html5doctype, $doctypeTest);

        $linkTest = $builder->a('http://google.com', 'Go to Google', [
            'class' => 'btn btn-primary',
            'target' => '_blank'
        ]);
        $this->assertEquals($link, $linkTest);
    }
}