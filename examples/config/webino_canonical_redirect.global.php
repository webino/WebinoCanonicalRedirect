<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino/WebinoCanonicalRedirect for the canonical source repository
 * @copyright   Copyright (c) 2014-2017 Webino, s. r. o. (http://webino.sk)
 * @license     BSD-3-Clause
 */

/**
 * Copy-paste this file to your config/autoload folder
 */
return [
    'webino_canonical_redirect' => [
        'enabled' => true,
        'www'     => false,   // bool = enabled|Site URI with www
        'slash'   => false,   // bool = enabled|Site URI with trailing slash
    ],
];
