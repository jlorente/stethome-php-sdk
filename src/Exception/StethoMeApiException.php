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

namespace Jlorente\StethoMe\Exception;

class StethoMeApiException extends \Exception
{

    /**
     * The error code returned by StethoMe.
     *
     * @var string
     */
    protected $errorCode;

    /**
     * The error type returned by StethoMe.
     *
     * @var string
     */
    protected $errorType;

    /**
     * The missing parameter returned by StethoMe with the error.
     *
     * @var string
     */
    protected $missingParameter;

    /**
     * The raw output returned by StethoMe in case of exception.
     *
     * @var string
     */
    protected $rawOutput;

    /**
     * Returns the error type returned by StethoMe.
     *
     * @return string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * Sets the error type returned by StethoMe.
     *
     * @param  string  $errorCode
     * @return $this
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    /**
     * Returns the error type returned by StethoMe.
     *
     * @return string
     */
    public function getErrorType()
    {
        return $this->errorType;
    }

    /**
     * Sets the error type returned by StethoMe.
     *
     * @param  string  $errorType
     * @return $this
     */
    public function setErrorType($errorType)
    {
        $this->errorType = $errorType;

        return $this;
    }

    /**
     * Returns missing parameter returned by StethoMe with the error.
     *
     * @return string
     */
    public function getMissingParameter()
    {
        return $this->missingParameter;
    }

    /**
     * Sets the missing parameter returned by StethoMe with the error.
     *
     * @param  string  $missingParameter
     * @return $this
     */
    public function setMissingParameter($missingParameter)
    {
        $this->missingParameter = $missingParameter;

        return $this;
    }

    /**
     * Returns raw output returned by StethoMe in case of exception.
     *
     * @return string
     */
    public function getRawOutput()
    {
        return $this->rawOutput;
    }

    /**
     * Sets the raw output parameter returned by StethoMe in case of exception.
     *
     * @param  string  $rawOutput
     * @return $this
     */
    public function setRawOutput($rawOutput)
    {
        $this->rawOutput = $rawOutput;

        return $this;
    }

}
