# Child Process Pool Phunin Node Plugin
[![Build Status](https://travis-ci.org/WyriHaximus/reactphp-child-process-pool-phunin-node-plugin.png)](https://travis-ci.org/WyriHaximus/reactphp-child-process-pool-phunin-node-plugin)
[![Latest Stable Version](https://poser.pugx.org/WyriHaximus/react-child-process-pool-phunin-node-plugin/v/stable.png)](https://packagist.org/packages/WyriHaximus/react-child-process-pool-phunin-node-plugin)
[![Total Downloads](https://poser.pugx.org/WyriHaximus/react-child-process-pool-phunin-node-plugin/downloads.png)](https://packagist.org/packages/WyriHaximus/react-child-process-pool-phunin-node-plugin)
[![Code Coverage](https://scrutinizer-ci.com/g/WyriHaximus/reactphp-child-process-pool-phunin-node-plugin/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/WyriHaximus/reactphp-child-process-pool-phunin-node-plugin/?branch=master)
[![License](https://poser.pugx.org/wyrihaximus/react-child-process-pool-phunin-node-plugin/license.png)](https://packagist.org/packages/wyrihaximus/react-child-process-pool-phunin-node-plugin)
[![PHP 7 ready](http://php7ready.timesplinter.ch/WyriHaximus/reactphp-child-process-pool-phunin-node-plugin/badge.svg)](https://travis-ci.org/WyriHaximus/reactphp-child-process-pool-phunin-node-plugin)

[`wyrihaximus/phunin-node` plugin](https://github.com/wyrihaximus/PhuninNode) for [`wyrihaximus/react-child-process-pool`](https://github.com/wyrihaximus/reactphp-child-process-pool/)

## Installation ##

To install via [Composer](http://getcomposer.org/), use the command below, it will automatically detect the latest version and bind it with `~`.

```
composer require wyrihaximus/react-child-process-pool-phunin-node-plugin 
```

## Usage ##

```php
use WyriHaximus\React\ChildProcess\Pool\PhuninNode\Pool;

$node->addPlugin(new Pool(
    $yourPoolInstance,
    'Your awesome pool', // Title
    'your_awesome_pool', // Slug
    'your_project',      // category
));
```

## Contributing ##

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License ##

Copyright 2015 [Cees-Jan Kiewiet](http://wyrihaximus.net/)

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.
