# Liquid

[![Build Status](https://travis-ci.org/gourmet/liquid.svg?branch=master)](https://travis-ci.org/gourmet/liquid)
[![Total Downloads](https://poser.pugx.org/gourmet/liquid/downloads.svg)](https://packagist.org/packages/gourmet/liquid)
[![License](https://poser.pugx.org/gourmet/liquid/license.svg)](https://packagist.org/packages/gourmet/liquid)

Built to enable [Liquid][liquid] templates in [CakePHP][cakephp].

## Requirements

* CakePHP 3.x

## Install

Using [Composer][composer]:

```
composer require gourmet/liquid
```

Because this plugin has the type `cakephp-plugin` set in its own `composer.json`,
[Composer][composer] will install it inside your /plugins directory, rather than
in your `vendor-dir`. It is recommended that you add /plugins/gourmet to your
`.gitignore` file and here's [why][composer:ignore].

You then need to load the plugin. In `boostrap.php`, something like:

```php
\Cake\Core\Plugin::load('Gourmet/Liquid');
```

You can then define any controller (or email) view class like so:

```php
// in ProductsController.php beforeFilter
$this->viewClass = '\Gourmet\Liquid\View\View';

// passed to any email configuration as the 'viewRender' key and use it:
Email::config(['user' => ['viewRender' => '\Gourmet\Liquid\View\View']]);
$email = new Email('user');
$email->template('Hello {{ name }}', "{{ 'content' | fetch }}\n\nThis is an automated email.")
    ->to('baker@cakephp.org')
    ->viewVars(['name' => 'Baker'])
    ->send();
```

More documentation/filters/tags to come.

In the meantime, read more about the library this plugin wraps over [here](/kalimatas/php-liquid)
and about the liquid markup [here](https://github.com/Shopify/liquid/wiki) and
[here](http://docs.shopify.com/themes/liquid-documentation/).

That's it!

## Patches & Features

* Fork
* Mod, fix
* Test - this is important, so it's not unintentionally broken
* Commit - do not mess with license, todo, version, etc. (if you do change any, bump them into commits of
their own that I can ignore when I pull)
* Pull request - bonus point for topic branches

## Bugs & Feedback

http://github.com/gourmet/knp-menu/issues

## License

Copyright (c) 2014, Jad Bitar and licensed under [The MIT License][mit].

[cakephp]:http://cakephp.org
[composer]:http://getcomposer.org
[composer:ignore]:http://getcomposer.org/doc/faqs/should-i-commit-the-dependencies-in-my-vendor-directory.md
[mit]:http://www.opensource.org/licenses/mit-license.php
[liquid]:https://github.com/Shopify/liquid
