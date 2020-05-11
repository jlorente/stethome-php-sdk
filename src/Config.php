<?php

/**
 * Part of the StethoMe package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    StethoMe
 * @version    1.0.0
 * @author     Jose Lorente
 * @license    BSD License (3-clause)
 * @copyright  (c) 2020, Jose Lorente
 */

namespace Jlorente\StethoMe;

class Config implements ConfigInterface
{

    /**
     * The current base URI.
     * 
     * @var string 
     */
    protected $baseUri;

    /**
     * The current package version.
     *
     * @var string
     */
    protected $version;

    /**
     * The StethoMe API key.
     *
     * @var string
     */
    protected $vendorToken;

    /**
     * The StethoMe API token.
     *
     * @var string
     */
    protected $requestRetries;

    /**
     * Constructor.
     *
     * @param  string  $version
     * @param  string  $vendorToken
     * @param  string  $requestRetries
     * @return void
     * @throws \RuntimeException
     */
    public function __construct($version, $vendorToken, $baseUri, $requestRetries = 0)
    {
        $this->setVersion($version);

        $this->setVendorToken($vendorToken ?: getenv('STETHOME_VENDOR_TOKEN'));

        $this->setBaseUri($baseUri ?: getenv('STETHOME_BASE_URI'));

        $this->setRequestRetries($requestRetries ?: getenv('STETHOME_REQUEST_RETRIES') ?: 0);

        if (!$this->vendorToken) {
            throw new \RuntimeException('The StethoMe vendor_token is not defined!');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaders()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * {@inheritdoc}
     */
    public function setBaseUri($uri)
    {
        $this->baseUri = $uri;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * {@inheritdoc}
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getVendorToken()
    {
        return $this->vendorToken;
    }

    /**
     * {@inheritdoc}
     */
    public function setVendorToken($vendorToken)
    {
        $this->vendorToken = $vendorToken;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestRetries()
    {
        return $this->requestRetries;
    }

    /**
     * {@inheritdoc}
     */
    public function setRequestRetries($retries)
    {
        $this->requestRetries = $retries;
        return $this;
    }

}
