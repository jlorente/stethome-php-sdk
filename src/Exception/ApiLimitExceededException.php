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

class ApiLimitExceededException extends StethoMeApiException
{

    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct('You have reached the StethoMe Api rate limit!');
    }

}
