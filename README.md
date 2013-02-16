# Site URL normalization for Zend Framework

  [![Build Status](https://secure.travis-ci.org/webino/WebinoCanonicalRedirect.png?branch=master)](http://travis-ci.org/webino/WebinoCanonicalRedirect "Master")
  [![Build Status](https://secure.travis-ci.org/webino/WebinoCanonicalRedirect.png?branch=develop)](http://travis-ci.org/webino/WebinoCanonicalRedirect "Develop")

  Allows you to configure www or trailing slash of your web site canonical URL. If wrong URL format is provided redirects to the normalized URL with HTTP 301.

  If you can't or don't know how to configure your server rewrites to handle URL duplicate content, this module is the smart solution.

  **Under development, please report any issues.**

## Features

  - Redirects `..domain.tld/index.php` to `..domain.tld/`
  - Configure site to use www  `www.domain.tld` or not `domain.tld`
  - Configure site to use trailing slash `..domain.tld/something/` or not `..domain.tld/something`

## Setup

  Following steps are necessary to get this module working, considering a zf2-skeleton or very similar application:

  1. Add `"minimum-stability": "dev"` to your composer.json, because this module is under development.
  2. Run: `php composer.phar require webino/webino-canonical-redirect:dev-develop`
  3. Add `WebinoCanonicalRedirect` to the enabled modules list.

## QuickStart

  - Copy, paste & override following settings to your configuration:

        'webino_uri_normalize' => array(
            'enabled' => true,
            'www'     => false,     // bool = enabled|Use URI with www
            'slash'   => false,     // bool = enabled|Use URI with trailing slash
        ),

## Todo

  - Tests

## Addendum

  Please, if you are interested in this Zend Framework module report any issues and don't hesitate to contribute.

[Report a bug](https://github.com/webino/WebinoCanonicalRedirect/issues) | [Fork me](https://github.com/webino/WebinoCanonicalRedirect)

