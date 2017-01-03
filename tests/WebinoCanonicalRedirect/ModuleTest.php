<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino/WebinoCanonicalRedirect for the canonical source repository
 * @copyright   Copyright (c) 2014-2017 Webino, s. r. o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoCanonicalRedirect;

use Zend\EventManager\EventManager;
use Zend\Http\Request;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\ServiceManager;

/**
 * Generated by PHPUnit on 2013-02-16 at 12:59:36.
 */
class ModuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Module
     */
    protected $object;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $canonicalizer;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $event;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $events;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $options;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $request;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Module;

        $app = $this->getMock(\Zend\Mvc\Application::class, [], [], '', false);
        $this->canonicalizer = $this->getMock(
            Uri\Canonicalizer::class,
            [],
            [],
            '',
            false
        );
        $this->event   = $this->getMock(MvcEvent::class);
        $this->events  = $this->getMock(EventManager::class);
        $this->options = $this->getMock(Options\ModuleOptions::class);
        $this->request = $this->getMock(Request::class);
        $services      = $this->getMock(ServiceManager::class);

        $this->event->expects($this->any())
            ->method('getApplication')
            ->will($this->returnValue($app));

        $app->expects($this->any())
            ->method('getServiceManager')
            ->will($this->returnValue($services));

        $app->expects($this->any())
            ->method('getEventManager')
            ->will($this->returnValue($this->events));

        $services->expects($this->any())
            ->method('get')
            ->will(
                $this->returnCallback(
                    function ($serviceName) {
                        switch ($serviceName) {

                            case Options\ModuleOptions::class:
                                return $this->options;

                            case Uri\Canonicalizer::class:
                                return $this->canonicalizer;

                            default:
                                $this->fail('Unexpected service ' . $serviceName);
                        }
                    }
                )
            );

        $this->options->expects($this->any())
            ->method('useWww')
            ->will($this->returnValue(true));

        $this->options->expects($this->any())
            ->method('useSlash')
            ->will($this->returnValue(true));
    }

    /**
     * @covers WebinoCanonicalRedirect\Module::getConfig
     */
    public function testGetConfig()
    {
        $this->assertInternalType('array', $this->object->getConfig());
    }

    /**
     * @covers WebinoCanonicalRedirect\Module::onBootstrap
     */
    public function testOnBootstrap()
    {
        $response = $this->getMock('Zend\Http\Response');
        $headers  = $this->getMock('Zend\Http\Headers');

        $this->event->expects($this->any())
            ->method('getRequest')
            ->will($this->returnValue($this->request));

        $this->options->expects($this->once())
            ->method('isEnabled')
            ->will($this->returnValue(true));

        $this->canonicalizer->expects($this->once())
            ->method('www')
            ->with(true)
            ->will($this->returnValue($this->canonicalizer));

        $this->canonicalizer->expects($this->once())
            ->method('trailingSlash')
            ->with(true);

        $this->canonicalizer->expects($this->once())
            ->method('isCanonicalized')
            ->will($this->returnValue(true));

        $this->event->expects($this->once())
            ->method('stopPropagation');

        $this->event->expects($this->once())
            ->method('getResponse')
            ->will($this->returnValue($response));

        $response->expects($this->once())
            ->method('setStatusCode')
            ->with(301)
            ->will($this->returnValue($response));

        $response->expects($this->once())
            ->method('getHeaders')
            ->will($this->returnValue($headers));

        $headers->expects($this->once())
            ->method('addHeaderLine')
            ->with('Location', $this->canonicalizer);

        $this->events->expects($this->once())
            ->method('trigger')
            ->with(
                $this->callback(function ($event) {
                    return MvcEvent::EVENT_FINISH === $event;
                }),
                $this->callback(function ($event) {
                    return $event !== $this->event;
                })
            );

        $this->object->onBootstrap($this->event);
    }

    /**
     * @covers WebinoCanonicalRedirect\Module::onBootstrap
     */
    public function testOnBootstrapUriNotCanonicalized()
    {
        $this->event->expects($this->any())
            ->method('getRequest')
            ->will($this->returnValue($this->request));

        $this->options->expects($this->once())
            ->method('isEnabled')
            ->will($this->returnValue(true));

        $this->canonicalizer->expects($this->once())
            ->method('www')
            ->will($this->returnValue($this->canonicalizer));

        $this->canonicalizer->expects($this->once())
            ->method('isCanonicalized')
            ->will($this->returnValue(false));

        $this->event->expects($this->never())
            ->method('stopPropagation');

        $this->event->expects($this->never())
            ->method('getResponse');

        $this->events->expects($this->never())
            ->method('trigger');

        $this->object->onBootstrap($this->event);
    }

    /**
     * @covers WebinoCanonicalRedirect\Module::onBootstrap
     */
    public function testOnBootstrapCanonicalizerDisabled()
    {
        $this->event->expects($this->any())
            ->method('getRequest')
            ->will($this->returnValue($this->request));

        $this->options->expects($this->once())
            ->method('isEnabled')
            ->will($this->returnValue(false));

        $this->canonicalizer->expects($this->never())
            ->method('www');

        $this->canonicalizer->expects($this->never())
            ->method('trailingSlash');

        $this->canonicalizer->expects($this->never())
            ->method('isCanonicalized')
            ->will($this->returnValue(false));

        $this->event->expects($this->never())
            ->method('stopPropagation');

        $this->event->expects($this->never())
            ->method('getResponse');

        $this->events->expects($this->never())
            ->method('trigger');

        $this->object->onBootstrap($this->event);
    }

    /**
     * @covers WebinoCanonicalRedirect\Module::onBootstrap
     */
    public function testOnBootstrapNoHttpRequest()
    {
        $this->event->expects($this->any())
            ->method('getRequest')
            ->will($this->returnValue(null));

        $this->options->expects($this->once())
            ->method('isEnabled')
            ->will($this->returnValue(true));

        $this->canonicalizer->expects($this->never())
            ->method('www');

        $this->canonicalizer->expects($this->never())
            ->method('trailingSlash');

        $this->canonicalizer->expects($this->never())
            ->method('isCanonicalized')
            ->will($this->returnValue(false));

        $this->event->expects($this->never())
            ->method('stopPropagation');

        $this->event->expects($this->never())
            ->method('getResponse');

        $this->events->expects($this->never())
            ->method('trigger');

        $this->object->onBootstrap($this->event);
    }
}
