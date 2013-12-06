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

use WebinoCanonicalRedirect\Uri\Canonicalizer;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Create a URI canonicalizer
 */
class CanonicalizerFactory implements FactoryInterface
{
    /**
     * @return Canonicalizer
     */
    public function createService(ServiceLocatorInterface $services)
    {
        $request = $services->get('Request');

        return new Canonicalizer($request->getUri(), $request->getBaseUrl());
    }
}
