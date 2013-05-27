<?php

namespace Thumbor\Url;

class BuilderFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testUrl()
    {
        $builder = BuilderFactory::construct('http://thumbor.example.com', 'butts')
            ->url();

        $expected = Builder::construct('http://thumbor.example.com', 'butts');

        $this->assertEquals($expected, $builder);
    }
}
