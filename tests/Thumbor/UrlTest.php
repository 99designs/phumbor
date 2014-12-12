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
            'http://thumbor-server:8888/bDv76lTvUdX6vORS96scx7P185c=/fit-in/560x420/filters:fill(green)/my/big/image.jpg',
            "$url"
        );
    }

    public function testToStringWithoutCommand()
    {
        $url = new Url(
            'http://thumbor-server:8888',
            'MY_SECURE_KEY',
            'my/big/image.jpg',
            array()
        );

        $this->assertEquals(
            'http://thumbor-server:8888/V2bYe7DAKqngbtv2GFxCcllDYWw=/my/big/image.jpg',
            "$url"
        );
    }
}
