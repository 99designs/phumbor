<?php

namespace Thumbor\Url;

class BuilderFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testUrl()
    {
        $server = 'http://thumbor.example.com';
        $secret = 'butts';
        $original = 'http://example.com/llamas.jpg';

        $builder = BuilderFactory::construct($server, $secret)
            ->url($original);

        $expected = Builder::construct($server, $secret, $original);

        $this->assertEquals($expected, $builder);
    }
}
