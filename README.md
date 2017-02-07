# PHP5 fork of spatie/schema-org

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

For the original documentation please refer to [spatie/schema-org](https://github.com/spatie/schema-org).

## Setup

Add the fork repository to your `composer.json`'s `repositories` section:
```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/derhasi/schema-org.git"
    }
  ],
}
```

After that you can require the _php5_ version with the [alias pattern](https://getcomposer.org/doc/articles/aliases.md)
like this:
```bash
composer require spatie/schema-org:"dev-php5 as 1.1.0"
```

## Changes

* Changed generator templates to produce PHP5-code
* Converted generator to PHP5 iva [7to5](https://github.com/spatie/7to5)
* Changed `BaseType->if()` to `BaseType->doIf()`

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
