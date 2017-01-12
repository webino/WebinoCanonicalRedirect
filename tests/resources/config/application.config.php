<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino/WebinoCanonicalRedirect for the canonical source repository
 * @copyright   Copyright (c) 2014-2017 Webino, s. r. o. (http://webino.sk)
 * @license     BSD-3-Clause
 */

namespace WebinoCanonicalRedirect;

/**
 * Test application config
 */
return [
    'modules' => [
        'WebinoDev',
        'WebinoDebug',
        __NAMESPACE__,
        'Application',
    ],
    'module_listener_options' => [
        'config_glob_paths' => [
            'config/autoload/{,*.}{global,local}.php',
        ],
        'config_static_paths' => [
            __DIR__ . '/module.config.php',
        ],
        'module_paths' => [
            'module',
            'vendor',
        ],
    ],
];
