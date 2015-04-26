# URI Canonicalizer <br /> for Zend Framework 2

[![Build Status](https://secure.travis-ci.org/webino/WebinoCanonicalRedirect.png?branch=develop)](http://travis-ci.org/webino/WebinoCanonicalRedirect "Develop Build Status")
[![Coverage Status](https://coveralls.io/repos/webino/WebinoCanonicalRedirect/badge.png?branch=develop)](https://coveralls.io/r/webino/WebinoCanonicalRedirect?branch=develop "Develop Coverage Status")
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/webino/WebinoCanonicalRedirect/badges/quality-score.png?s=f608383f40b945e5667f9a0e1ae9c41616454a13)](https://scrutinizer-ci.com/g/webino/WebinoCanonicalRedirect/ "Quality Score")
[![Dependency Status](https://www.versioneye.com/user/projects/52a19caa632bac3bd6000040/badge.png)](https://www.versioneye.com/user/projects/52a19caa632bac3bd6000040 "Develop Dependency Status")
<br />
[![Latest Stable Version](https://poser.pugx.org/webino/webino-canonical-redirect/v/stable.png)](https://packagist.org/packages/webino/webino-canonical-redirect "Latest Stable Version")
[![Total Downloads](https://poser.pugx.org/webino/webino-canonical-redirect/downloads.png)](https://packagist.org/packages/webino/webino-canonical-redirect "Total Downloads")
[![Latest Unstable Version](https://poser.pugx.org/webino/webino-canonical-redirect/v/unstable.png)](https://packagist.org/packages/webino/webino-canonical-redirect "Latest Unstable Version")
[![License](https://poser.pugx.org/webino/webino-canonical-redirect/license.svg)](https://packagist.org/packages/webino/webino-canonical-redirect)


  Allows you to configure www and trailing slash of your web site canonical URI. If wrong URI format is provided redirects to the canonicalized URI with HTTP 301.

  If you can't or don't know how to configure your web server rewrites to handle URI duplicate content, this module is the smart solution.

  **Under development, please report any issues.**

## Features

  - Redirects `..domain.tld/index.php` to `..domain.tld`
  - Configure site to use www  `www.domain.tld` or not `domain.tld`
  - Configure site to use trailing slash `..domain.tld/something/` or not `..domain.tld/something`

## Setup

  Following steps are necessary to get this module working, considering a zf2-skeleton or very similar application:

  1. Run: `php composer.phar require webino/webino-canonical-redirect:dev-develop`
  3. Add `WebinoCanonicalRedirect` to the enabled modules list

## QuickStart

Copy, paste & override following settings to your configuration:

    'webino_canonical_redirect' => array(
        'enabled' => true,
        'www'     => false,     // bool = enabled|Use URI with www
        'slash'   => false,     // bool = enabled|Use URI with trailing slash
    ),

## Development
[![Dependency Status](https://www.versioneye.com/user/projects/553c37fc1d2989f7ee000153/badge.svg?style=flat)](https://www.versioneye.com/user/projects/553c37fc1d2989f7ee000153)

We will appreciate any contributions on development of this module.

Learn [How to develop Webino modules](https://github.com/webino/Webino/wiki/How-to-develop-Webino-module)

## Addendum

  Please, if you are interested in this Zend Framework module report any issues and don't hesitate to contribute.

[Report a bug](https://github.com/webino/WebinoCanonicalRedirect/issues) | [Fork me](https://github.com/webino/WebinoCanonicalRedirect)

