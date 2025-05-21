<div align="center">

<h1 align="center" style="border-bottom: none; margin-bottom: 0px">Larative 🗣️</h1>
<h3 align="center" style="margin-top: 0px">Vocative Service Provider for Larative</h3>

[![Packagist Version](https://img.shields.io/packagist/v/oblak/vocative-laravel?label=Release&style=flat-square&logo=packagist&logoColor=white)](https://packagist.org/packages/oblak/vocative-laravel)
![Packagist PHP Version](https://img.shields.io/packagist/dependency-v/oblak/vocative-laravel/php?label=PHP&logo=php&logoColor=white&logoSize=auto&style=flat-square)
[![Total Downloads](https://img.shields.io/packagist/dt/oblak/vocative-laravel.svg?style=flat-square&logo=transmission)](https://packagist.org/packages/oblak/vocative-laravel)

</div>

This library allows you to effortlessly convert Serbian personal names to their correct vocative form in your Laravel application.


## Installation

You can install the package via composer:

```bash
composer require oblak/vocative-laravel
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="vocative-config"
```

This is the contents of the published config file:

```php
<?php

return [
    'dictionary' => [],
    'ignore_dictionary' => false,
];
```

## Usage

You can use the package in your application by calling the `Vocative` class directly or using the provided Blade directives.

### Using the Facade

You can use the `Vocative` facade to transform names to their vocative form:

```php
use Oblak\Vocative\Facades\Vocative;

// Transform a name to vocative case
echo Vocative::make('Милица'); // "Милице"
echo Vocative::make('Марко');  // "Марко"

// Force transformation (bypass dictionary)
echo Vocative::make('Лука', true); // Forces transformation even if in dictionary
```

### Using Blade Directives

The package provides two Blade directives for convenient use in your templates:

```blade
{{-- Using @vocative directive --}}
Hello, @vocative('Милица')!

{{-- Using the shorter @voc alias --}}
Hello, @voc('Марко')!
```

### Custom Dictionary

You can define custom vocative forms in the configuration file:

```php
// config/vocative.php
return [
    'dictionary' => [
        'CUSTOM_NAME' => 'CUSTOM_VOCATIVE_FORM',
        'Лука' => 'Луко',
    ],
    'ignore_dictionary' => false, // Set to true to always force transformation
];
```


## Testing

```bash
composer test
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
