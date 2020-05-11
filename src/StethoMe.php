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

class StethoMe
{

    /**
     * The package version.
     *
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * The Config repository instance.
     *
     * @var \Jlorente\StethoMe\ConfigInterface
     */
    protected $config;

    /**
     * Constructor.
     *
     * @param string $vendorToken
     * @param string $baseUri
     * @param int $requestRetries
     * @return void
     */
    public function __construct($vendorToken = null, $baseUri = null, $requestRetries = null)
    {
        $this->config = new Config(self::VERSION, $vendorToken, $baseUri, $requestRetries);
    }

    /**
     * Create a new StethoMe API instance.
     *
     * @param string $vendorToken
     * @param int $requestRetries
     * @return \Jlorente\StethoMe\StethoMe
     */
    public static function make($vendorToken = null, $requestRetries = null)
    {
        return new static($vendorToken, $requestRetries);
    }

    /**
     * Returns the current package version.
     *
     * @return string
     */
    public static function getVersion()
    {
        return self::VERSION;
    }

    /**
     * Returns the Config repository instance.
     *
     * @return \Jlorente\StethoMe\ConfigInterface
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Sets the Config repository instance.
     *
     * @param  \Jlorente\StethoMe\ConfigInterface  $config
     * @return $this
     */
    public function setConfig(ConfigInterface $config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Returns the StethoMe API key.
     *
     * @return string
     */
    public function getVendorToken()
    {
        return $this->config->getVendorToken();
    }

    /**
     * Sets the StethoMe API key.
     *
     * @param string $vendorToken
     * @return $this
     */
    public function setVendorToken($vendorToken)
    {
        $this->config->setVendorToken($vendorToken);

        return $this;
    }

    /**
     * Dynamically handle missing methods.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return \Jlorente\StethoMe\Core\ApiInterface
     */
    public function api()
    {
        return new Api($this->config);
    }

}
