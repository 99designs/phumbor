A minimal PHP client for [Thumbor][1].

Usage:
```php
$original = 'http://images.example.com/llamas.jpg';
$commands = array('fit-in', '640x480', 'filters:fill(green)');

$server = 'http://thumbor.example.com:1234/';
$secret = 'my-secret-key';

echo new \Thumbor\Url($original, $commands, $server, $secret);
// => http://thumbor.example.com:1234/mYdVBN25gyqUGD3QRsI9_rl1IxQ=/fit-in/640x480/filters:fill(green)/http%3A%2F%2Fimages.example.com%2Fllamas.jpg
```
