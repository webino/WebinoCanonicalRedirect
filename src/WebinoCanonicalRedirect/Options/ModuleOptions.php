<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino/WebinoCanonicalRedirect for the canonical source repository
 * @copyright   Copyright (c) 2013 Webino, s. r. o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     New BSD License
 */

namespace WebinoCanonicalRedirect\Options;

use Zend\Stdlib\AbstractOptions;

/**
 * WebinoCanonicalRedirect module options
 */
class ModuleOptions extends AbstractOptions
{
    /**
     * @var bool
     */
    protected $enabled = true;

    /**
     * @var bool
     */
    protected $www = false;

    /**
     * @var bool
     */
    protected $slash = false;

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = (bool) $enabled;
    }

    /**
     * @return bool
     */
    public function useWww()
    {
        return $this->www;
    }

    /**
     * @param bool $www
     */
    public function setWww($www)
    {
        $this->www = (bool) $www;
    }

    /**
     * @return bool
     */
    public function useSlash()
    {
        return $this->slash;
    }

    /**
     * @param bool $slash
     */
    public function setSlash($slash)
    {
        $this->slash = (bool) $slash;
    }
}
