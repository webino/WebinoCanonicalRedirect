<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino/WebinoCanonicalRedirect for the canonical source repository
 * @copyright   Copyright (c) 2013 Webino, s. r. o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     New BSD License
 */

namespace WebinoCanonicalRedirect\Factory;

use WebinoCanonicalRedirect\Options\ModuleOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Factory for the module options
 */
class ModuleOptionsFactory implements FactoryInterface
{
    /**
     * @return ModuleOptions
     */
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('Config');

        return new ModuleOptions(
            !empty($config['webino_canonical_redirect'])
            ? $config['webino_canonical_redirect']
            : array()
        );
    }
}
