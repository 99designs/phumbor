# Phumbor

A minimal PHP client for generating [Thumbor][1] URLs.

[![Build Status](https://travis-ci.org/99designs/phumbor.png)](https://travis-ci.org/99designs/phumbor)


## Usage

You construct a `Thumbor\Url` using a `Thumbor\Url\Builder`:

```php
$server = 'http://thumbor.example.com:1234';
$secret = 'my-secret-key';

echo Thumbor\Url\Builder::construct($server, $secret, 'http://images.example.com/llamas.jpg')
    ->fitIn(640, 480)
    ->addFilter('fill', 'green');

// => http://thumbor.example.com:1234/mYdVBN25gyqUGD3QRsI9_rl1IxQ=/fit-in/640x480/filters:fill(green)/http%3A%2F%2Fimages.example.com%2Fllamas.jpg
```

To reuse your server/secret combination, create a `Thumbor\Url\BuilderFactory`:

```php
$thumbnailUrlFactory = Thumbor\Url\BuilderFactory::construct($server, $secret);

echo $thumbnailUrlFactory
    ->url('http://images.example.com/llamas.jpg')
    ->fitIn(640, 480)
    ->addFilter('fill', 'green');

echo $thumbnailUrlFactory
    ->url('http://images.example.com/butts.png')
    ->crop(20, 20, 300, 300)
    ->valign('middle');

// etc
```


## Installation

Add `99designs/phumbor` as a dependency in [`composer.json`][3].

A [Laravel 4 package][4] is available.


## License

MIT; see [`LICENSE`][2]

 [1]: https://github.com/globocom/thumbor
 [2]: https://github.com/99designs/phumbor/blob/master/LICENSE
 [3]: https://getcomposer.org/
 [4]: https://github.com/ceejayoz/laravel-phumbor
