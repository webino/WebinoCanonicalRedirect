<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino/WebinoCanonicalRedirect for the canonical source repository
 * @copyright   Copyright (c) 2014-2015 Webino, s. r. o. (http://webino.sk)
 * @license     BSD-3-Clause
 */

namespace WebinoCanonicalRedirect;

use WebinoCanonicalRedirect\Factory\CanonicalizerFactory;
use WebinoCanonicalRedirect\Factory\ModuleOptionsFactory;
use WebinoCanonicalRedirect\Options\ModuleOptions;
use WebinoCanonicalRedirect\Uri\Canonicalizer;

/**
 * Do not write your custom settings into this file
 */
return [
    'service_manager' => [
        'factories' => [
            ModuleOptions::class => ModuleOptionsFactory::class,
            Canonicalizer::class => CanonicalizerFactory::class,
        ],
    ],
];
