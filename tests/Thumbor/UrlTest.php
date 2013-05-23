<?php

namespace Thumbor;

class UrlTest extends \PHPUnit_Framework_TestCase
{
    public function testSign()
    {
        $this->assertEquals(
            '-qITCsYPvj2Lt0ivIX1eXHhGFOM=',
            Url::sign(
                'fit-in/560x420/filters:fill(green)/my%2Fbig%2Fimage.jpg',
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
            'http://thumbor-server:8888/-qITCsYPvj2Lt0ivIX1eXHhGFOM=/fit-in/560x420/filters:fill(green)/my%2Fbig%2Fimage.jpg',
            "$url"
        );
    }
}
