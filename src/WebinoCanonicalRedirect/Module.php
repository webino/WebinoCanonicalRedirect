<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino/WebinoCanonicalRedirect for the canonical source repository
 * @copyright   Copyright (c) 2014-2017 Webino, s. r. o. (http://webino.sk)
 * @license     BSD-3-Clause
 */

namespace WebinoCanonicalRedirect;

use WebinoCanonicalRedirect\Options\ModuleOptions;
use WebinoCanonicalRedirect\Uri\Canonicalizer;
use Zend\Http\Request as HttpRequest;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;

/**
 * WebinoCanonicalRedirect module
 */
class Module implements
    BootstrapListenerInterface,
    ConfigProviderInterface
{
    /**
     * Redirect to the canonicalized URI path
     *
     * @param EventInterface|MvcEvent $event
     * @return void
     */
    public function onBootstrap(EventInterface $event)
    {
        $app      = $event->getApplication();
        $services = $app->getServiceManager();
        $options  = $services->get(ModuleOptions::class);

        if (!$options->isEnabled()
            || !($event->getRequest() instanceof HttpRequest)
        ) {
            return;
        }

        $uri = $services->get(Canonicalizer::class);
        $uri
            ->www($options->useWww())
            ->trailingSlash($options->useSlash());

        if (!$uri->isCanonicalized()) {
            return;
        }

        $event->stopPropagation();

        $response = $event->getResponse();
        /** @var \Zend\Http\Response $response */
        $response
            ->setStatusCode(301)
            ->getHeaders()
            ->addHeaderLine('Location', $uri);

        unset($uri);

        $app->getEventManager()
            ->trigger(MvcEvent::EVENT_FINISH, (new MvcEvent)->setResponse($response));
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }
}
