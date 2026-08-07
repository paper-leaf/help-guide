# Help Guide

[![Latest Version on Packagist](https://img.shields.io/packagist/v/paper-leaf/help-guide.svg?style=flat-square)](https://packagist.org/packages/paper-leaf/help-guide)

Help Guide provides contextual help and guidance throughout your Filament application, making it easier for users to understand and navigate your application.

## Installation

You can install the package via composer:

```bash
composer require paper-leaf/help-guide
```

> [!IMPORTANT]
> If you have not set up a custom theme and are using Filament Panels follow the instructions in the [Filament Docs](https://filamentphp.com/docs/4.x/styling/overview#creating-a-custom-theme) first.

After setting up a custom theme add the plugin's views to your theme css file or your app's css file if using the standalone packages.

```css
@source '../../../../vendor/paper-leaf/help-guide/resources/**/*.blade.php';
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="help-guide-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="help-guide-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="help-guide-views"
```

## Usage

Ensure you have `->default()` set on your primary panel you are intalling this plugin on.

Register the plugin within your default panel's definition.

```php
use PaperLeaf\HelpGuide\HelpGuidePlugin;

->plugin(
    HelpGuidePlugin::make()
)
```

The plugin can be customized in the following ways:

### Ability to Manage the Guide

Set which users can access the "Manage Guide" section of the panel. Only users who have the specificied permission will see any edit functionality within the Help Guide.

```php
->plugin(
    HelpGuidePlugin::make()
        ->manageGuidePermission('gate_name')
)
```

### Available Permissions

Define the list of permissions that users can have within the system. These need to be tied to Gates within Laravel. Then these permissions can be assigned to help pages, and only users with that permission can view that page.

```php
->plugin(
    HelpGuidePlugin::make()
        ->availablePermissions(fn() => SystemPermission::toArray())
)
```

### Login URL

Specify the login URL of your main dashboard so unauthenticated users accessing the Help Guide are redirected to the correct login page.

```php
->plugin(
    HelpGuidePlugin::make()
        ->loginUrl('/custom-url')
)
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

Please review [our security policy](.github/SECURITY.md) on how to report security vulnerabilities.

## Credits

- [Sarah Tinga](https://github.com/s-tinga)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
