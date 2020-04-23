<?php

namespace Thumbor;

use PHPUnit\Framework\TestCase;

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
            ['fit-in', '560x420', 'filters:fill(green)']
        );

        $this->assertEquals(
            'http://thumbor-server:8888/-qITCsYPvj2Lt0ivIX1eXHhGFOM=/fit-in/560x420/filters:fill(green)/my%2Fbig%2Fimage.jpg',
            $url
        );
    }

    public function testToStringWithoutCommand()
    {
        $url = new Url(
            'http://thumbor-server:8888',
            'MY_SECURE_KEY',
            'my/big/image.jpg',
            []
        );

        $this->assertEquals(
            'http://thumbor-server:8888/vdLL3uSYX2E-btLe6X6JVzDccD0=/my%2Fbig%2Fimage.jpg',
            "$url"
        );
    }

    public function testOriginalUrlIsEncoded()
    {
        $url = new Url(
            'http://thumbor-server:8888',
            'MY_SECURE_KEY',
            'http://original.host:1234/foo?bar=baz&quu=qux',
            []
        );

        $this->assertEquals(
            'http://thumbor-server:8888/Y0lt8M2fp89Gxkg8UyQSOlFOpns=/http%3A%2F%2Foriginal.host%3A1234%2Ffoo%3Fbar%3Dbaz%26quu%3Dqux',
            (string) $url
        );
    }
}
