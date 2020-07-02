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

use Jlorente\StethoMe\Core\Api as CoreApi;

/**
 * Class Security.
 * 
 * @author Jose Lorente <jose.lorente.martin@gmail.com>
 * @see https://dev.middleware.stethome.com/docs/?url=/docs/file/v2/swagger.yaml#/security
 */
class Security extends CoreApi
{

    /**
     * Generate client token for end user device.
     *
     * @return string
     * @see https://dev.middleware.stethome.com/docs/?url=/docs/file/v2/swagger.yaml#/security/get_token
     */
    public function getToken()
    {
        return $this->getAccessToken($this->config);
    }

    /**
     * Generate client token for end user device, scoped to given visits ids (recommended).
     *
     * @param array $params
     * @return string
     * @see https://dev.middleware.stethome.com/docs/?url=/docs/file/v2/swagger.yaml#/security/post_token
     */
    public function postToken(array $params)
    {
        return $this->acquireScopedAccessToken($this->config, $params);
    }

}
