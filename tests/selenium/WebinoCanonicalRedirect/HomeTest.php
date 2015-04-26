<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino/WebinoCanonicalRedirect for the canonical source repository
 * @copyright   Copyright (c) 2014-2015 Webino, s. r. o. (http://webino.sk)
 * @license     BSD-3-Clause
 */

namespace WebinoCanonicalRedirect;

/**
 * Class HomeTest
 */
class HomeTest extends AbstractTestCase
{
    /**
     *
     */
    public function testHome()
    {
        $this->openOk();

        $this->session->open($this->uri . 'index.php');
        $url = $this->session->url();
        $this->assertRegExp('~\/(?!index.php)$~', $url);
        $this->session->open($this->uri . 'index.php?anyQueryParams=test');
        $url = $this->session->url();
        $this->assertRegExp('~\/(?!index.php)\?anyQueryParams=test$~', $url);
        $this->session->open($this->uri . 'index.php/test-path/?anyQueryParams=test');
        $url = $this->session->url();
        $this->assertRegExp('~\/(?!index.php)test-path\?anyQueryParams=test$~', $url);
        $this->session->open($this->uri . 'test-trailing-slash/');
        $url = $this->session->url();
        $this->assertRegExp('~\/test-trailing-slash$~', $url);
    }
}
