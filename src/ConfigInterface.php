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

interface ConfigInterface
{

    /**
     * Returns the API base uri.
     *
     * @return string
     */
    public function baseUri();

    /**
     * Returns the current package version.
     *
     * @return string
     */
    public function getVersion();

    /**
     * Sets the current package version.
     *
     * @param  string  $version
     * @return $this
     */
    public function setVersion($version);

    /**
     * Returns the StethoMe API key.
     *
     * @return string
     */
    public function getVendorToken();

    /**
     * Sets the StethoMe API key.
     *
     * @param string $vendorToken
     * @return $this
     */
    public function setVendorToken($vendorToken);

    /**
     * Returns the StethoMe request retries value.
     *
     * @return string
     */
    public function getRequestRetries();

    /**
     * Sets the StethoMe API key.
     *
     * @param string $retries
     * @return $this
     */
    public function setRequestRetries($retries);
}
