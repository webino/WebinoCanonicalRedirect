<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino/WebinoCanonicalRedirect for the canonical source repository
 * @copyright   Copyright (c) 2013 Webino, s. r. o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     New BSD License
 */

namespace WebinoCanonicalRedirect\Uri;

use Zend\Uri\UriInterface;

/**
 * URI Canonicalizer
 */
class Canonicalizer
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
    protected $isCanonicalized = false;

    /**
     * @param UriInterface $uri
     */
    public function __construct(UriInterface $uri, $baseUrl = null)
    {
        $this->uri     = $uri;
        $this->baseUrl = $baseUrl;
        $uriPath       = $this->uri->getPath();

        if (false !== strpos($uriPath, '/index.php')) {

            $this->uri->setPath(str_replace('/index.php', '', $uriPath));
            $this->isCanonicalized = true;
        }
    }

    /**
     * Return true if URI was canonicalized
     *
     * @return bool
     */
    public function isCanonicalized()
    {
        return $this->isCanonicalized;
    }

    /**
     * Canonicalize URI to use www or not
     *
     * @param bool $useWww
     * @return self
     */
    public function www($useWww)
    {
        $host        = $this->uri->getHost();
        $has         = (0 === strpos($host, 'www'));
        $isSubdomain = (!$has && 2 <= substr_count($host, '.'));

        if (($has && $useWww) || (!$has && !$useWww)
            || $isSubdomain
        ) {
            return $this;
        }

        $host = $useWww ? 'www.' . $host : preg_replace('~^www\.~', '', $host);
        $this->uri->setHost($host);
        $this->isCanonicalized = true;

        return $this;
    }

    /**
     * Canonicalize URI to use trailingSlash or not
     *
     * @param bool $useTrailingSlash
     * @return self
     */
    public function trailingSlash($useTrailingSlash)
    {
        $fullUriPath = $this->uri->getPath();
        $uriPath     = trim($fullUriPath, '/');
        $baseUrl     = trim($this->baseUrl, '/');

        if (empty($uriPath) || $uriPath === $baseUrl) {
            return $this;
        }

        $has = ('/' === $fullUriPath[strlen($fullUriPath) - 1]);
        $use = ($useTrailingSlash && !preg_match('~\.[a-zA-Z0-9]{1,}$~', $uriPath));

        if (($has && $use) || (!$has && !$use)) {
            return $this;
        }

        $newUriPath = $use ? '/' . $uriPath . '/' : '/' . $uriPath;
        $this->uri->setPath($newUriPath);
        $this->isCanonicalized = true;

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
        } catch (\Exception $exc) {
            return '';
        }
    }
}
