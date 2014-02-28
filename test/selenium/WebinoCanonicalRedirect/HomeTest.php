<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino/WebinoCanonicalRedirect for the canonical source repository
 * @copyright   Copyright (c) 2014 Webino, s. r. o. (http://webino.sk)
 * @license     The BSD 3-Clause License
 */

namespace WebinoCanonicalRedirect;

/**
 * @author Peter Bačinský <peter@bacinsky.sk>
 */
class HomeTest extends AbstractBase
{
    /**
     *
     */
    public function testHome()
    {
        $this->session->open($this->uri);

        $src = $this->session->source();
        $this->assertNotContains('Error', $src, null, true);
        $this->assertNotContains('Exception', $src, null, true);

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
