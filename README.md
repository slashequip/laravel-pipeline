# Laravel Pipeline

[![Latest Version on Packagist](https://img.shields.io/packagist/v/slashequip/laravel-pipeline.svg?style=flat-square)](https://packagist.org/packages/slashequip/laravel-pipeline)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/slashequip/laravel-pipeline/run-tests?label=tests)](https://github.com/slashequip/laravel-pipeline/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/slashequip/laravel-pipeline/Check%20&%20fix%20styling?label=code%20style)](https://github.com/slashequip/laravel-pipeline/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/slashequip/laravel-pipeline.svg?style=flat-square)](https://packagist.org/packages/slashequip/laravel-pipeline)

An opinionated, improved pipeline for Laravel projects to help breakdown complex logic into easily readable chunks.

## Installation

You can install the package via composer:

```bash
composer require slashequip/laravel-pipeline
```

## Usage

For full usage view the [full documentation](https://laravelpipeline.com).

```php
$pipeline = Pipeline::make();
$pipeline->send(UserRegistrationTransport::make());
$pipeline->through(
    CreateUserPipe::make(),
    NotifyUserRegisteredPipe::make(),
    AddUserToSegmentPipe::make(),
    LogUserInPipe::make()
);
$finalTransportState = $pipeline->deliver();
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
