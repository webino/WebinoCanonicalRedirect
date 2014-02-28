<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino/WebinoCanonicalRedirect for the canonical source repository
 * @copyright   Copyright (c) 2014 Webino, s. r. o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

/**
 * Do not write your custom settings into this file
 */
return array(
    'service_manager' => array(
        'factories' => array(
            'WebinoCanonicalRedirect\Options\ModuleOptions' => 'WebinoCanonicalRedirect\Factory\ModuleOptionsFactory',
            'WebinoCanonicalRedirect\Uri\Canonicalizer'     => 'WebinoCanonicalRedirect\Factory\CanonicalizerFactory',
        ),
    ),
);
