<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino/WebinoCanonicalRedirect for the canonical source repository
 * @copyright   Copyright (c) 2014-2017 Webino, s. r. o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
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
     * @param ServiceLocatorInterface $services
     * @return Canonicalizer
     */
    public function createService(ServiceLocatorInterface $services)
    {
        $request = $services->get('Request');
        return new Canonicalizer($request->getUri(), $request->getBaseUrl());
    }
}
