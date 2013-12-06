<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino/WebinoCanonicalRedirect for the canonical source repository
 * @copyright   Copyright (c) 2013 Webino, s. r. o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     New BSD License
 */

namespace WebinoCanonicalRedirect;

use Zend\Http\Request as HttpRequest;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * WebinoCanonicalRedirect module
 */
class Module implements
    AutoloaderProviderInterface,
    BootstrapListenerInterface,
    ConfigProviderInterface
{
    /**
     * Redirect to thecanonicalized URI path
     *
     * @param EventInterface $event
     */
    public function onBootstrap(EventInterface $event)
    {
        /* @var $event \Zend\Mvc\MvcEvent */

        $config  = $event->getApplication()->getConfig();
        $request = $event->getRequest();

        if (empty($config['webino_canonical_redirect'])
            || empty($config['webino_canonical_redirect']['enabled'])
            || !($request instanceof HttpRequest)
        ) {
            return;
        }

        $uri = new Uri\Normalize($request->getUri(), $request->getBaseUrl());

        $uri
            ->www(!empty($config['webino_canonical_redirect']['www']))
            ->trailingSlash(!empty($config['webino_canonical_redirect']['slash']));

        if (!$uri->isCanonicalized()) {
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
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }
}
