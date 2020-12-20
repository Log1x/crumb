# Crumb

![Latest Stable Version](https://img.shields.io/packagist/v/log1x/crumb?style=flat-square)
![Build Status](https://img.shields.io/circleci/build/github/Log1x/crumb?style=flat-square)
![Total Downloads](https://img.shields.io/packagist/dt/log1x/crumb?style=flat-square)

A simple breadcrumb package for Sage 10.

## Requirements

- [Sage](https://github.com/roots/sage) >= 10.0
- [PHP](https://secure.php.net/manual/en/install.php) >= 7.2.5
- [Composer](https://getcomposer.org/download/)

## Installation

Install via Composer:

```bash
$ composer require log1x/crumb
```

## Usage

Publish the breadcrumb configuration file using Acorn:

```sh
$ wp acorn vendor:publish --provider="Log1x\Crumb\CrumbServiceProvider"
```

### Basic Usage

```php
use Log1x\Crumb\Facades\Crumb;

return Crumb::build()->toArray();
```

## Bug Reports

If you discover a bug in Crumb, please [open an issue](https://github.com/log1x/crumb/issues).

## Contributing

Contributing whether it be through PRs, reporting an issue, or suggesting an idea is encouraged and appreciated.

## License

Crumb is provided under the [MIT License](https://github.com/log1x/crumb/blob/master/LICENSE.md).
