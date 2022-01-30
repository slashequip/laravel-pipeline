# An opinionated, improved pipeline for Laravel projects to help breakdown complex logic into easily readable chunks.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/slashequip/laravel-pipeline.svg?style=flat-square)](https://packagist.org/packages/slashequip/laravel-pipeline)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/slashequip/laravel-pipeline/run-tests?label=tests)](https://github.com/slashequip/laravel-pipeline/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/slashequip/laravel-pipeline/Check%20&%20fix%20styling?label=code%20style)](https://github.com/slashequip/laravel-pipeline/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/slashequip/laravel-pipeline.svg?style=flat-square)](https://packagist.org/packages/slashequip/laravel-pipeline)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-pipeline.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-pipeline)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require slashequip/laravel-pipeline
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-pipeline-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-pipeline-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-pipeline-views"
```

## Usage

```php
$laravelPipeline = new Slashequip\LaravelPipeline();
echo $laravelPipeline->echoPhrase('Hello, Slashequip!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Sam Jones](https://github.com/slashequip)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
