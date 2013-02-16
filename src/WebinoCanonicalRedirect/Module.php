<?php
/**
 * Webino (http://webino.sk/)
 *
 * @copyright   Copyright (c) 2013 Webino, s. r. o. (http://webino.sk/)
 * @license     New BSD License
 * @package     WebinoCanonicalRedirect
 */

namespace WebinoCanonicalRedirect;

use Zend\Mvc\MvcEvent;

/**
 * @category    Webino
 * @package     WebinoCanonicalRedirect
 * @author      Peter Bačinský <peter@bacinsky.sk>
 */
class Module
{

    /**
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/../../autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/../../src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * Redirect to the normalized URI path
     *
     * @param \Zend\Mvc\MvcEvent $event
     * @return void
     */
    public function onBootstrap(MvcEvent $event)
    {
        $config = $event->getApplication()->getConfig();

        if (empty($config['webino_canonical_redirect'])
            || empty($config['webino_canonical_redirect']['enabled'])
        ) {
            return;
        }

        $request = $event->getRequest();
        $uri     = new Uri\Normalize($request->getUri(), $request->getBaseUrl());

        $uri
            ->www(!empty($config['webino_canonical_redirect']['www']))
            ->trailingSlash(!empty($config['webino_canonical_redirect']['slash']));

        if (!$uri->isNormalized()) {
            return;
        }

        $event->stopPropagation();

        $event
            ->getResponse()
            ->setStatusCode(301)
            ->getHeaders()
            ->addHeaderLine('Location', $uri);

        unset($uri);

        $event
            ->getApplication()
            ->getEventManager()
            ->trigger(MvcEvent::EVENT_FINISH, $event);
    }

}
