<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino/WebinoCanonicalRedirect for the canonical source repository
 * @copyright   Copyright (c) 2014 Webino, s. r. o. (http://webino.sk)
 * @license     The BSD 3-Clause License
 */

namespace WebinoCanonicalRedirect;

use PHPWebDriver_WebDriver;
use RuntimeException;

/**
 * @author Peter Bačinský <peter@bacinsky.sk>
 */
abstract class AbstractBase extends \PHPUnit_Framework_TestCase
{
    /**
     * Selenium Web Driver Host URI
     */
    const WEB_DRIVER_HOST = 'http://localhost:4444/wd/hub';

    /**
     * @var string
     */
    protected $uri;

    /**
     * @var PHPWebDriver_WebDriver
     */
    protected $webDriver;

    /**
     * @var PHPWebDriver_WebDriverSession
     */
    protected $session;

    /**
     *
     */
    public function setUp()
    {
        $this->uri       = $this->resolveUri();
        $this->webDriver = new PHPWebDriver_WebDriver(self::WEB_DRIVER_HOST);
        $this->session   = $this->webDriver->session('htmlunit');
    }

    /**
     *
     */
    public function tearDown()
    {
        $this->session->close();
    }

    /**
     * Resolve test target URI
     *
     * @return string
     */
    public function resolveUri()
    {
        $uri = getenv('URI');
        if (empty($uri)) {
            throw new RuntimeException('Expected URI env');
        }

        return $uri;
    }
}
