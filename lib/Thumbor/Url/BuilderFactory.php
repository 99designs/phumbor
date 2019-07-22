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
     * @var string
     */
    private $baseUrl;

    /**
     * @param string $server
     * @param string|null $secret
     * @return BuilderFactory
     */
    public static function construct($server, $secret=null)
    {
        return new self($server, $secret);
    }

    /**
     * @param string $server
     * @param string|null $secret
     */
    public function __construct($server, $secret=null)
    {
        $this->server = $server;
        $this->secret = $secret;
    }

    /**
     * @param $url
     * @return $this
     */
    public function baseUrl($url)
    {
        $this->baseUrl = $url;
        return $this;
    }

    /**
     * @param string $original
     * @return Builder
     */
    public function url($original)
    {
        if (!is_null($this->baseUrl)) {
            $original = "{$this->baseUrl}/$original";
        }
        return Builder::construct($this->server, $this->secret, $original);
    }
}
