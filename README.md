# WordPress Toolkit

> Work with common WordPress Plugin and Theme APIs in a
  modern, object-oriented way.

By [Max Melzer](https://www.moehrenzahn.de)

The WordPress Toolkit is a [Composer](https://getcomposer.org)
module that offers easy access to common WordPress functionality,
inspired by modern PHP frameworks like [Symfony](https://symfony.com).

It's aim is to provide consistent, object-oriented methods
for WordPress plugin and theme development.

## Installation

To use the toolkit, add it to your theme or plugin via
[Composer](https://getcomposer.org).

```sh
cd wp-content/themes/your-awesome-theme
composer init
composer require moehrenzahn/wp-toolkit
```

Then, you can initialize the Client class in your PHP script. This is
the entry point to all functionality of the toolkit.

```php
<?php
$client = new \Moehrenzahn\Toolkit\Api\Client();
```

## Requirements

- [Composer](https://getcomposer.org)
- PHP >= 7.1
- WordPress >= 5.0 (older versions may work but are untested)

## Features

- convenient API around Wordpress action and filter management
- object manager with simple, automatic dependency injection
- template rendering with Model-View-Controller architecture
- add and manage
    - JavaScript files
    - CSS files
    - image sizes
    - shortcodes
    - virtual user accounts
    - Transients
    - Post Types
    - Post Terms and Meta
    - Post Meta boxes
    - Post filters
    - comment Meta
    - comment Meta boxes
    - settings pages
    - admin pages
    - admin notices
    - AJAX actions
    - POST actions

## Usage example

Add a **CSS file** to your theme:

```php
<?php
// Entry point for all actions is the Client object
$client = new \Moehrenzahn\Toolkit\Api\Client();
$stylesheets = $client->getStylesheetManager();
$stylesheets->add('eule-stylesheet', 'src/css/style.css', '1.0.0');
```

Add a **shortcode** with a custom template:

```php
<?php
$client = new \Moehrenzahn\Toolkit\Api\Client();
$shortcodes = $client->getShortcodeManager();
$shortcodes->add(
    'my-shortcode',
    $client->getViewFactory()->create('shortcode-template.phtml')
);
```

Create a **custom settings page** with pre-built input type templates.

```php
<?php
$client = new \Moehrenzahn\Toolkit\Api\Client();
$client->getAdminPageManager()->addSettingsPage(
    'Sample settings page',
    'sample-settings-page',
    getSections($client)
);

/**
 * @param \Moehrenzahn\Toolkit\Api\Client $client
 * @return Moehrenzahn\Toolkit\View\Settings\Section[]
 */
function getSections(\Moehrenzahn\Toolkit\Api\Client $client): array
{
    $sectionBuilder = $client->getSettingsSectionBuilder();
    $sectionBuilder->addSetting(
        'my-sample-setting',
        'A sample setting title',
        \Moehrenzahn\Toolkit\AdminPage\SettingsSectionBuilder::SETTING_TYPE_BOOLEAN,
        'A sample setting description.'
    );

    $sectionBuilder->addSetting(
        'my-sample-select',
        'Select your thing',
        \Moehrenzahn\Toolkit\AdminPage\SettingsSectionBuilder::SETTING_TYPE_SELECT,
        'You can also do select inputs!',
       [
           'sample-option-value' => 'Sample option label',
           'another-option-value' => 'Another option!',
       ]
    );
    
    return [$sectionBuilder->create('sample-section', 'A sample settings section')];
}
```

Use the built-in `View` class to render your templates and get
access to features like **lazy-loading images and partials**:

```php
<?php /** @var \Moehrenzahn\Toolkit\View $view */ ?>
<h2>Here comes a lazy-loaded partial that is only loaded when it's scrolled into view:</h2>
<?php $view->renderLazyPartial(
    'your-template-to-load.phtml',
    'your-static-placeholder-template.phtml'
) ?>
```

Use the **object manager** to initalize objects with automatic dependency resolution.

```php
<?php 
$client = new \Moehrenzahn\Toolkit\Api\Client();
$objectManager = $client->getObjectManager();
/**
 * The object manager will try to automatically and recursively
 * resolve all dependencies of the given class.
 * Don't use this for very large projects since it can impact performance.
 */
$customObject = $objectManager->getSingleton(YourCustomClass::class);
```

## Release History

* 1.0.0
    * Initial release

## Meta

Max Melzer – [@_maxmelzer](https://twitter.com/_maxmelzer) – hi@moehrenzahn.de

Distributed under the GNU General Public License. See ``LICENSE.md`` for more information.

[https://github.com/moehrenzahn](https://github.com/moehrenzahn/)

## Contributing

1. Fork it (<https://github.com/moehrenzahn/wp-toolkit/fork>)
2. Create your feature branch (`git checkout -b feature/fooBar`)
3. Commit your changes (`git commit -am 'Add some fooBar'`)
4. Push to the branch (`git push origin feature/fooBar`)
5. Create a new Pull Request
