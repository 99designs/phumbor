<?php

namespace Thumbor;

/**
 * Generate URLs that point to a Thumbor server
 * @see https://github.com/globocom/thumbor
 */
class Url
{
    private $server, $secret, $original, $commands;

    /**
     * See stringify()
     */
    public function __construct($server, $secret, $original, $commands)
    {
        $this->server = $server;
        $this->secret = $secret;
        $this->original = $original;
        $this->commands = $commands;
    }

    /**
     * Produce a URL to an image on a Thumbor server according to the specified
     * options.
     *
     * See https://github.com/globocom/thumbor/wiki/Usage for available $commands.
     *
     * @param string $server   Thumbor server
     * @param string $secret   shared secret key (may be blank/null)
     * @param string $original URL of original image
     * @param array  $commands array of Thumbor commands
     */
    public function stringify($server, $secret, $original, $commands)
    {
        $original = urlencode($original);
        $commandPath = implode('/', $commands);
        $signature = $secret ? $this->sign("$commandPath/$original", $secret) : 'unsafe';

        return sprintf(
            '%s/%s/%s/%s',
            $server,
            $signature,
            $commandPath,
            $original
        );
    }

    /**
     * Sign a message using a shared secret key, per
     * https://github.com/globocom/thumbor/wiki/Libraries
     *
     * @param string $msg
     * @param string $secret
     * @return string
     */
    public function sign($msg, $secret)
    {
        $signature = hash_hmac("sha1", $msg, $secret, true);
        return strtr(
            base64_encode($signature),
            '/+', '_-'
        );
    }

    public function __toString()
    {
        return $this->stringify(
            $this->server,
            $this->secret,
            $this->original,
            $this->commands
        );
    }
}
