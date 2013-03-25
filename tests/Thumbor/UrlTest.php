<?php

namespace Thumbor;

class UrlTest extends \PHPUnit_Framework_TestCase
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
            'my/big/image.jpg',
            array('fit-in', '560x420', 'filters:fill(green)'),
            'http://thumbor-server:8888',
            'MY_SECURE_KEY'
        );

        $this->assertEquals(
            'http://thumbor-server:8888/bDv76lTvUdX6vORS96scx7P185c=/fit-in/560x420/filters:fill(green)/my%2Fbig%2Fimage.jpg',
            "$url"
        );
    }
}
