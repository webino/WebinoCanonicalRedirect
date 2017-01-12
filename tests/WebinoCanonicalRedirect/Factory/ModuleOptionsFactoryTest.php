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
use WebinoCanonicalRedirect\Options\ModuleOptions;
use Zend\ServiceManager\ServiceManager;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-12-06 at 17:28:04.
 */
class ModuleOptionsFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ModuleOptionsFactory
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new ModuleOptionsFactory;
    }

    /**
     * @covers WebinoCanonicalRedirect\Factory\ModuleOptionsFactory::createService
     */
    public function testCreateService()
    {
        $config   = array('webino_canonical_redirect' => array());
        $services = $this->getMock(ServiceManager::class);

        $services->expects($this->once())
            ->method('get')
            ->with('Config')
            ->will($this->returnValue($config));

        $options = $this->object->createService($services);
        $this->assertInstanceOf(ModuleOptions::class, $options);
    }
}
