# Liquid

Built to enable [Liquid][liquid] templates in [CakePHP][cakephp].

__This is an unstable repository and should be treated as an alpha.__

## Requirements

* CakePHP 3.x

## Install

Using [Composer][composer]:

```
composer require gourmet/liquid
```

Because this plugin has the type `cakephp-plugin` set in its own `composer.json`,
[Composer][composer] will install it inside your /plugins directory, rather than
in your `vendor-dir`. It is recommended that you add /plugins/gourmet/liquid to your
`.gitignore` file and here's [why][composer:ignore].

TODO: ADD MORE DETAILS HERE

That's it!

## License

Copyright (c) 2014, Jad Bitar and licensed under [The MIT License][mit].

[cakephp]:http://cakephp.org
[composer]:http://getcomposer.org
[composer:ignore]:http://getcomposer.org/doc/faqs/should-i-commit-the-dependencies-in-my-vendor-directory.md
[mit]:http://www.opensource.org/licenses/mit-license.php
[liquid]:https://github.com/Shopify/liquid
