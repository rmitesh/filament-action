# Filament Action

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rmitesh/filament-action.svg?style=flat-square)](https://packagist.org/packages/rmitesh/filament-action)
[![Total Downloads](https://img.shields.io/packagist/dt/rmitesh/filament-action.svg?style=flat-square)](https://packagist.org/packages/rmitesh/filament-action)

Designed for easy integration and manage of <a href="https://filamentphp.com/">Filament</a> actions.

## Installation

You can install the package via composer:

```bash
composer require rmitesh/filament-action
```

## Usage

```php
php artisan make:filament-action User Comment
```
This command generates a new Filament action class called `CommentAction` for the `UserResource`
This action class will be used to define the logic and behavior for handling custom action in `UserResource` within the Filament admin panel.

Now, in `UserResource` register this action
```php
public static function table(Table $table): Table
{
	return $table
		->actions([
			// ...
			CommentAction::make(),
		])
}
```
![image](https://github.com/rmitesh/filament-action/assets/48554454/c51cdfbb-78ec-491b-8aae-7f5b8dd16992)

![image](https://github.com/rmitesh/filament-action/assets/48554454/158c008a-7197-4ed1-82a3-25c5aa615a20)

You can use same methods available in the <a href="https://filamentphp.com/docs/2.x/tables/actions">Filament Table Action</a>

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email meet.drive32@gmail.com instead of using the issue tracker.

## Credits

-   [Mitesh Rathod](https://github.com/rmitesh)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
