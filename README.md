# Phumbor

A minimal PHP client for generating [Thumbor][thumbor] URLs.

[![Build Status](https://travis-ci.org/99designs/phumbor.png)](https://travis-ci.org/99designs/phumbor)


## Usage

You construct a `Thumbor\Url` using a `Thumbor\Url\Builder`:

```php
$server = 'http://thumbor.example.com:1234';
$secret = 'my-secret-key';

echo Thumbor\Url\Builder::construct($server, $secret, 'http://images.example.com/llamas.jpg')
    ->fitIn(640, 480)
    ->addFilter('fill', 'green');

// => http://thumbor.example.com:1234/OFDRoURwi9WVbZNfeOJVfIKr1Js=/fit-in/640x480/filters:fill(green)/http://images/example.com/llamas.jpg
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

Add `99designs/phumbor` as a dependency in [`composer.json`][composer].

A [Laravel 4 package][laravel-phumbor] and a [Symfony2 Bundle][symfony-bundle] are also available.


## License

MIT; see [`LICENSE`][license]


 [thumbor]: https://github.com/globocom/thumbor
 [license]: https://github.com/99designs/phumbor/blob/master/LICENSE
 [composer]: https://getcomposer.org/
 [laravel-phumbor]: https://github.com/ceejayoz/laravel-phumbor
 [symfony-bundle]: https://github.com/jbouzekri/PhumborBundle
