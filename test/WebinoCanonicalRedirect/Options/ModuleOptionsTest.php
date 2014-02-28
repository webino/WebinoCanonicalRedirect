<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino/WebinoCanonicalRedirect for the canonical source repository
 * @copyright   Copyright (c) 2014 Webino, s. r. o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoCanonicalRedirect\Options;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-12-06 at 17:21:17.
 *
 * @covers \WebinoCanonicalRedirect\Options\ModuleOptions
 */
class ModuleOptionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ModuleOptions
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new ModuleOptions;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    /**
     *
     */
    public function testAssertDefaultOptions()
    {
        $this->assertTrue($this->object->isEnabled());
        $this->assertFalse($this->object->useWww());
        $this->assertFalse($this->object->useSlash());
    }

    /**
     *
     */
    public function testSettersAndGetters()
    {
        $options = new ModuleOptions(
            array(
                'enabled' => false,
                'www'     => true,
                'slash'   => true,
            )
        );

        $this->assertFalse($options->isEnabled());
        $this->assertTrue($options->useWww());
        $this->assertTrue($options->useSlash());
    }
}
