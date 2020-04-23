<?php

namespace Thumbor\Url;

use PHPUnit\Framework\TestCase;
use Thumbor\Url;

class BuilderTest extends TestCase
{
    public function testBuild()
    {
        $url = Builder::construct('http://thumbor.example.com', 'butts', 'http://example.com/llamas.jpg')
            ->fitIn(320, 240)
            ->smartCrop(true)
            ->addFilter('brightness', 42)
            ->build();

        $expected = new Url(
            'http://thumbor.example.com',
            'butts',
            'http://example.com/llamas.jpg',
            array(
                'fit-in/320x240',
                'smart',
                'filters:brightness(42)'
            )
        );

        $this->assertEquals($expected, $url);
    }

    public function testToString()
    {
        $url = (string) Builder::construct('http://thumbor.example.com', 'butts', 'http://example.com/llamas.jpg')
            ->fitIn(320, 240)
            ->smartCrop(true)
            ->addFilter('brightness', 42);

        $expected = 'http://thumbor.example.com/y8O2zwNvj1D6rv1qpaHTUiZjgG0=/fit-in/320x240/smart/filters:brightness(42)/http%3A%2F%2Fexample.com%2Fllamas.jpg';

        $this->assertEquals($expected, $url);
    }
}
