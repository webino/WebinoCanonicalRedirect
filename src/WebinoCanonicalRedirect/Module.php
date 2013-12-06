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
use Zend\Mvc\MvcEvent;

/**
 * WebinoCanonicalRedirect module
 */
class Module implements
    AutoloaderProviderInterface,
    BootstrapListenerInterface,
    ConfigProviderInterface
{
    /**
     * Redirect to the canonicalized URI path
     *
     * @param EventInterface $event
     */
    public function onBootstrap(EventInterface $event)
    {
        /* @var $event MvcEvent */

        $app      = $event->getApplication();
        $services = $app->getServiceManager();
        $options  = $services->get('WebinoCanonicalRedirect\Options\ModuleOptions');

        if (!$options->isEnabled()
            || !($event->getRequest() instanceof HttpRequest)
        ) {
            return;
        }

        $uri = $services->get('WebinoCanonicalRedirect\Uri\Canonicalizer');
        $uri
            ->www($options->useWww())
            ->trailingSlash($options->useSlash());

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

        $app->getEventManager()
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
