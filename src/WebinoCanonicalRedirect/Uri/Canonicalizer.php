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
 *
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
    public function __construct(UriInterface $uri, $baseUrl = null, $entryBaseName = '/index.php')
    {
        $this->uri     = $uri;
        $this->baseUrl = $baseUrl;
        $uriPath       = $this->uri->getPath();

        if (false !== strpos($uriPath, $entryBaseName)) {

            $this->uri->setPath(str_replace($entryBaseName, '', $uriPath));
            $this->isCanonicalized = true;
        }
    }

    /**
     * Return true if URI was normalized
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
        $host = $this->uri->getHost();
        $use  = $useWww && preg_match('~^(.+\.)?.+\..{2,}$~', $host);
        $has  = preg_match('~^.+\..+\.~', $host);

        if (($use && $has) || (!$use && !$has)) {
            return $this;
        }

        $host = $use ? 'www.' . $host : preg_replace('~^www\.~', '', $host);
        $this->uri->setHost($host);
        $this->isCanonicalized = true;

        return $this;
    }

    /**
     * Sanitize URI to use trailingSlash or not
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

        $use = ($useTrailingSlash && !preg_match('~\.[a-zA-Z0-9]{1,}$~', $uriPath));
        $has = ('/' === $fullUriPath[strlen($fullUriPath) - 1]);

        if (($use && $has) || (!$use && !$has)) {
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
