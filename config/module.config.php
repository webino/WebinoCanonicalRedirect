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
 * Do not write your custom settings into this file
 */
return array(
    'webino_canonical_redirect' => array(
        'enabled' => true,
        'www'     => false,        // bool = enabled|Site URI with www
        'slash'   => false,        // bool = enabled|Site URI with trailing slash
        'entry'   => '/index.php', // string = Entry file base name
    ),
);
