# Site URI Canonicalizer <br /> for Zend Framework 2

  [![Build Status](https://secure.travis-ci.org/webino/WebinoCanonicalRedirect.png?branch=master)](http://travis-ci.org/webino/WebinoCanonicalRedirect "Master Build Status")
  [![Coverage Status](https://coveralls.io/repos/webino/WebinoCanonicalRedirect/badge.png?branch=master)](https://coveralls.io/r/webino/WebinoCanonicalRedirect?branch=master "Master Coverage Status")
  [![Dependency Status](https://www.versioneye.com/user/projects/52a21914632bac3e8600007c/badge.png)](https://www.versioneye.com/user/projects/52a21914632bac3e8600007c "Master Dependency Status")
  [![Build Status](https://secure.travis-ci.org/webino/WebinoCanonicalRedirect.png?branch=develop)](http://travis-ci.org/webino/WebinoCanonicalRedirect "Develop Build Status")
  [![Coverage Status](https://coveralls.io/repos/webino/WebinoCanonicalRedirect/badge.png?branch=develop)](https://coveralls.io/r/webino/WebinoCanonicalRedirect?branch=develop "Develop Coverage Status")
  [![Dependency Status](https://www.versioneye.com/user/projects/52a19caa632bac3bd6000040/badge.png)](https://www.versioneye.com/user/projects/52a19caa632bac3bd6000040 "Develop Dependency Status")

  [![Latest Stable Version](https://poser.pugx.org/webino/webino-draw/v/stable.png)](https://packagist.org/packages/webino/webino-draw "Latest Stable Version")
  [![Latest Unstable Version](https://poser.pugx.org/webino/webino-draw/v/unstable.png)](https://packagist.org/packages/webino/webino-draw "Latest Unstable Version")
  [![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/webino/WebinoCanonicalRedirect/badges/quality-score.png?s=f608383f40b945e5667f9a0e1ae9c41616454a13)](https://scrutinizer-ci.com/g/webino/WebinoCanonicalRedirect/ "Quality Score")
  [![Daily Downloads](https://poser.pugx.org/webino/webino-draw/d/daily.png)](https://packagist.org/packages/webino/webino-draw "Daily Downloads")
  [![Montly Downloads](https://poser.pugx.org/webino/webino-draw/d/monthly.png)](https://packagist.org/packages/webino/webino-draw "Monthly Downloads")
  [![Total Downloads](https://poser.pugx.org/webino/webino-draw/downloads.png)](https://packagist.org/packages/webino/webino-draw "Total Downloads")


  Allows you to configure www and trailing slash of your web site canonical URI. If wrong URI format is provided redirects to the normalized URI with HTTP 301.

  If you can't or don't know how to configure your web server rewrites to handle URI duplicate content, this module is the smart solution.

  **Under development, please report any issues.**

## Features

  - Redirects `..domain.tld/index.php` to `..domain.tld`
  - Configure site to use www  `www.domain.tld` or not `domain.tld`
  - Configure site to use trailing slash `..domain.tld/something/` or not `..domain.tld/something`

## Setup

  Following steps are necessary to get this module working, considering a zf2-skeleton or very similar application:

  1. Run: `php composer.phar require webino/webino-canonical-redirect:0.*`
  3. Add `WebinoCanonicalRedirect` to the enabled modules list

## QuickStart

  - Copy, paste & override following settings to your configuration:

        'webino_canonical_redirect' => array(
            'enabled' => true,
            'www'     => false,     // bool = enabled|Use URI with www
            'slash'   => false,     // bool = enabled|Use URI with trailing slash
        ),

## Develop

**Requirements**

  - [Linux](http://www.ubuntu.com/download)
  - [NetBeans](https://netbeans.org/downloads/) (optional)
  - [Phing](http://www.phing.info/trac/wiki/Users/Download)
  - [PHPUnit](http://phpunit.de/manual/3.7/en/installation.html)
  - [PSR-2 coding style](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)
  - [Web browser](https://www.google.com/intl/sk/chrome/browser/) (recommended)
  - [Selenium](http://www.seleniumhq.org/) (optional)

### Setup

  1. Clone this repository and run: `phing update`

     *Now your development environment is set.*

  2. Open project in (NetBeans) IDE

  3. To check module integration with the skeleton application open following directory via web browser:
     `._test/ZendSkeletonApplication/public/`

     e.g. [http://localhost/WebinoCanonicalRedirect/._test/ZendSkeletonApplication/public/](http://localhost/WebinoCanonicalRedirect/._test/ZendSkeletonApplication/public/)

  4. Integration test resources are in directory: `test/resources`

### Testing

  - Run `phpunit` in the test directory
  - Run `phing test` in the module directory to run the tests and code analysis

    *NOTE: To run the code analysis there are some tool requirements.*
      - [apigen](http://apigen.org/##installation)
      - [pdepend](http://pdepend.org/)
      - [phpcb](https://github.com/Mayflower/PHP_CodeBrowser)
      - [phpcpd](https://github.com/sebastianbergmann/phpcpd)
      - [phpcs](http://pear.php.net/package/PHP_CodeSniffer/)
      - [phploc](https://github.com/sebastianbergmann/phploc)
      - [phpmd](http://phpmd.org/download/index.html)

    *NOTE: Those tools are present after development environment is based.*

## Addendum

  Please, if you are interested in this Zend Framework module report any issues and don't hesitate to contribute.

[Report a bug](https://github.com/webino/WebinoCanonicalRedirect/issues) | [Fork me](https://github.com/webino/WebinoCanonicalRedirect)

