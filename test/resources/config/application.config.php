<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino/WebinoCanonicalRedirect for the canonical source repository
 * @copyright   Copyright (c) 2013 Webino, s. r. o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     New BSD License
 */

/**
 * WebinoCanonicalRedirect application test config
 */
return array(
    'modules' => array(
        'WebinoCanonicalRedirect',
        'Application',
    ),
    'module_listener_options' => array(
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            'WebinoCanonicalRedirect' => __DIR__ . '/../../src',
            'module',
            'vendor',
        ),
    ),
);
