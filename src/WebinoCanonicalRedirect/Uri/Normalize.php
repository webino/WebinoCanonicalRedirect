<?php
/**
 * Webino (http://webino.sk/)
 *
 * @copyright   Copyright (c) 2013 Webino, s. r. o. (http://webino.sk/)
 * @license     New BSD License
 * @package     WebinoCanonicalRedirect
 */

namespace WebinoCanonicalRedirect\Uri;

use Zend\Uri\UriInterface;

/**
 * @category    Webino
 * @package     WebinoCanonicalRedirect
 * @subpackage  WebinoCanonicalRedirect\Uri
 * @author      Peter Bačinský <peter@bacinsky.sk>
 */
class Normalize
{

    /**
     * @var UriInterface
     */
    protected $uri;

    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * @var bool
     */
    protected $isNormalized = false;

    /**
     * @param \Zend\Uri\UriInterface $uri
     */
    public function __construct(UriInterface $uri, $baseUrl = null)
    {
        $this->uri     = $uri;
        $this->baseUrl = $baseUrl;
        $uriPath       = $this->uri->getPath();

        if (false !== strpos($uriPath, '/index.php')) {

            $this->uri->setPath(str_replace('/index.php', '', $uriPath));

            $this->isNormalized = true;

        }
    }

    /**
     * Return true if URI was normalized
     *
     * @return bool
     */
    public function isNormalized()
    {
        return $this->isNormalized;
    }

    /**
     * Sanitize URI to use www or not
     *
     * @param bool $useWww
     * @return \WebinoUriFormat\Uri\Sanitize
     */
    public function www($useWww)
    {
        $host = $this->uri->getHost();
        $use  = $useWww && preg_match('~^(www\.)?.+\..{2,}$~', $host);
        $has  = preg_match('~^www\.~', $host);

        if (($use && $has) || (!$use && !$has)) {
            return $this;
        }

        if ($use) {
            $host = 'www.' . $host;
        } else {
            $host = preg_replace('~^www\.~', '', $host);
        }

        $this->uri->setHost($host);

        $this->isNormalized = true;

        return $this;
    }

    /**
     * Sanitize URI to use trailingSlash or not
     *
     * @param bool $useTrailingSlash
     * @return \WebinoUriFormat\Uri\Sanitize
     */
    public function trailingSlash($useTrailingSlash)
    {
        $fullUriPath = $this->uri->getPath();
        $uriPath     = trim($fullUriPath, '/');
        $baseUrl     = trim($this->baseUrl, '/');

        if (empty($uriPath) || $uriPath === $baseUrl) {
            return $this;
        }

        $use = ($useTrailingSlash && !preg_match('~\.[a-zA-Z0-9]{1,}$~', $uriPath));
        $has = ('/' === $fullUriPath[strlen($fullUriPath) - 1]);

        if (($use && $has) || (!$use && !$has)) {
            return $this;
        }

        if ($use) {
            $this->uri->setPath('/' . $uriPath . '/');
        } else {
            $this->uri->setPath('/' . $uriPath);
        }

        $this->isNormalized = true;

        return $this;
    }

    /**
     * Return URI as string
     *
     * @return string
     */
    public function toString()
    {
        return $this->uri->toString();
    }

    /**
     * Magic method to convert the URI to a string
     *
     * @return string
     */
    public function __toString()
    {
        try {
            return $this->toString();
        } catch (\Exception $e) {
            return '';
        }
    }

}
