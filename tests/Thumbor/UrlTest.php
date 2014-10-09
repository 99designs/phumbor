<?php

namespace Thumbor;

use PHPUnit_Framework_TestCase as TestCase;

class UrlTest extends TestCase
{
    public function testSign()
    {
        $this->assertEquals(
            'bDv76lTvUdX6vORS96scx7P185c=',
            Url::sign(
                'fit-in/560x420/filters:fill(green)/my/big/image.jpg',
                'MY_SECURE_KEY'
            )
        );
    }

    public function testToString()
    {
        $url = new Url(
            'http://thumbor-server:8888',
            'MY_SECURE_KEY',
            'my/big/image.jpg',
            array('fit-in', '560x420', 'filters:fill(green)')
        );

        $this->assertEquals(
            'http://thumbor-server:8888/-qITCsYPvj2Lt0ivIX1eXHhGFOM=/fit-in/560x420/filters:fill(green)/my%2Fbig%2Fimage.jpg',
            "$url"
        );
    }

    public function testToStringWithAbsoluteUrl()
    {
        $url = new Url(
            'http://thumbor-server:8888',
            'MY_SECURE_KEY',
            'http://example.org/my/big/image.jpg',
            array('fit-in', '560x420', 'filters:fill(green)')
        );

        $this->assertEquals(
            'http://thumbor-server:8888/RbTNMbAMGJBS3c3oiy57VaIqs64=/fit-in/560x420/filters:fill(green)/http%3A%2F%2Fexample.org%2Fmy%2Fbig%2Fimage.jpg',
            "$url"
        );
    }

    public function testOriginalUrlIsNotDoubleEncoded()
    {
        $url = new Url(
            'http://thumbor-server:8888',
            'MY_SECURE_KEY',
            'http%3A%2F%2Fexample.org%2Fmy%2Fbig%2Fimage.jpg',
            array('fit-in', '560x420', 'filters:fill(green)')
        );

        $this->assertEquals(
            'http://thumbor-server:8888/RbTNMbAMGJBS3c3oiy57VaIqs64=/fit-in/560x420/filters:fill(green)/http%3A%2F%2Fexample.org%2Fmy%2Fbig%2Fimage.jpg',
            "$url"
        );
    }
}
