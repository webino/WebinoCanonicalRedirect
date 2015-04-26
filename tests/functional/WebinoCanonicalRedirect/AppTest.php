<?php
/**
 * Webino (http://webino.sk/)
 *
 * @link        https://github.com/webino/WebinoCanonicalRedirect/ for the canonical source repository
 * @copyright   Copyright (c) 2014-2015 Webino, s. r. o. (http://webino.sk/)
 * @license     BSD-3-Clause
 */

namespace WebinoCanonicalRedirect;

use /** @noinspection PhpUnusedAliasInspection */
    Yandex\Allure\Adapter\Annotation\Title;
use WebinoDev\Test;
use Zend\ServiceManager\ServiceManager;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-10-13 at 14:36:20.
 */
class AppTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Zend\Mvc\Application
     */
    protected $app;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->app = Test\createApp();
    }

    /**
     * @Title("Application works")
     */
    public function testGetServiceManager()
    {
        $this->assertInstanceOf(ServiceManager::class, $this->app->getServiceManager());
    }
}
