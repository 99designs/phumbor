<?php

namespace Thumbor\Url;

/**
 * Produces URL builders for a given server/secret combination. Useful when the
 * server/secret combination is consistent across your whole app. E.g.
 *
 *     // global variable
 *     $thumbnailUrlFactory = Thumbor\Url\BuilderFactory::construct(
 *         'http://thumbor.example.com',
 *         'secret'
 *     );
 *
 *     // elsewhere in your app
 *     echo $thumbnailUrlFactory
 *         ->urlFrom('http://example.com/llamas.jpg')
 *         ->fitIn(320, 240)
 *         // etc
 *         ;
 */
class BuilderFactory
{
    private $server;
    private $secret;

    /**
     * @param $server
     * @param null $secret
     * @return BuilderFactory
     */
    public static function construct($server, $secret=null)
    {
        return new self($server, $secret);
    }

    /**
     * BuilderFactory constructor.
     * @param $server
     * @param null $secret
     */
    public function __construct($server, $secret=null)
    {
        $this->server = $server;
        $this->secret = $secret;
    }

    /**
     * @param $original
     * @return Builder
     */
    public function url($original)
    {
        return Builder::construct($this->server, $this->secret, $original);
    }
}
