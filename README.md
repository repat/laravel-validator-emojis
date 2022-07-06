# laravel-validator-emojis

[![Latest Version on Packagist](https://img.shields.io/packagist/v/repat/laravel-validator-emojis.svg?style=flat-square)](https://packagist.org/packages/repat/laravel-validator-emojis)
[![Total Downloads](https://img.shields.io/packagist/dt/repat/laravel-validator-emojis.svg?style=flat-square)](https://packagist.org/packages/repat/laravel-validator-emojis)

**laravel-validator-emojis** is a [custom Rule Object / Validator](https://laravel.com/docs/8.x/validation#custom-validation-rules) for Laravel that validates emojis using [steppinghat/emoji-detector](https://packagist.org/packages/steppinghat/emoji-detector)

## Installation

`$ composer require repat/laravel-validator-emojis`

## Documentation

```php

use Illuminate\Http\Request;
use Repat\LaravelRules\ContainsEmojis;
use Repat\LaravelRules\DoesntContainEmojis;

// ...

public function controllerMethod(Request $request) {
    // Contains ANY emoji
    $request->validate([
        'string_to_validate' => new ContainsEmojis(),
    ]);

    // Contains ANY of given emoji
    $request->validate([
        'string_to_validate' => new ContainsEmojis(["🪂", "🤿"]), // $all = false
    ]);

    // Contains ALL given emoji
    $request->validate([
        'string_to_validate' => new ContainsEmojis(emojis: ["🔑", "🟤"], all: true),
    ]);

    // Contains NO emojis at all
    $request->validate([
        'string_to_validate' => new DoesntContainEmojis(),
    ]);
}

```

## Tests

```sh
vendor/bin/phpunit
```

## License

* MIT, see [LICENSE](https://github.com/repat/laravel-validator-emojis/blob/master/LICENSE)

## Version

* Version 0.1

## Contact

### repat

* Homepage: [https://repat.de](https://repat.de)
* e-mail: repat@repat.de
* Twitter: [@repat123](https://twitter.com/repat123 "repat123 on twitter")

[![Flattr this git repo](http://api.flattr.com/button/flattr-badge-large.png)](https://flattr.com/submit/auto?user_id=repat&url=https://github.com/repat/laravel-validator-emojis&title=laravel-validator-emojis&language=&tags=github&category=software)
