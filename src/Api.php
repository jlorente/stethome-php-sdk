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

use GuzzleHttp\RequestOptions;
use Jlorente\StethoMe\Core\Api as CoreApi;

/**
 * Class Api.
 * 
 * @author Jose Lorente <jose.lorente.martin@gmail.com>
 * @see https://documenter.getpostman.com/view/6250828/S17m1BbV?version=latest
 */
class Api extends CoreApi
{

    /**
     * Returns a client token.
     *
     * @param string $token
     * @return string
     * @see https://documenter.getpostman.com/view/6250828/S17m1BbV?version=latest#79b4672f-642c-4e47-8b89-7d7fe29762de
     */
    public function getToken()
    {
        return $this->getAccessToken($this->config);
    }

    /**
     * Check processing status of all recordings associated with given visit id.
     * 
     * @param string $visitId
     * @return array
     * @see https://documenter.getpostman.com/view/6250828/S17m1BbV?version=latest#947e93dc-97d0-4864-8b6b-24d15f018770
     */
    public function getVisit(string $visitId)
    {
        return $this->_get("visit/$visitId/check");
    }

    /**
     * Check processing status of single recording associated with given visit id.
     *
     * @param string $visitId
     * @param int $point
     * @return array
     * @see https://documenter.getpostman.com/view/6250828/S17m1BbV?version=latest#7b46673b-5505-41e1-bf61-6f0babe54964
     */
    public function getPoint(string $visitId, int $point)
    {
        return $this->_get("visit/$visitId/recording/$point/check");
    }

    /**
     * Get analysed tags for a single recording from given visit id.
     *
     * @param string $visitId
     * @param int $point
     * @return array
     * @see https://documenter.getpostman.com/view/6250828/S17m1BbV?version=latest#a664d3ed-4931-4fec-bc1b-c71cdc28f68a
     */
    public function getPointTags(string $visitId, int $point)
    {
        return $this->_get("visit/$visitId/recording/$point/tags");
    }

    /**
     * Get single recording audio file for playback.
     *
     * @param string $visitId
     * @param int $point
     * @return array
     * @see https://documenter.getpostman.com/view/6250828/S17m1BbV?version=latest#35ad2fca-bc3c-4977-95c0-c034cad6270c
     */
    public function getPointWav(string $visitId, int $point)
    {
        return $this->_get("visit/$visitId/recording/$point/wav");
    }

    /**
     * Generate visit ID. All subsequent client requests will have to send this 
     * ID to properly match all recordings to same visit.
     *
     * @param string $pushId
     * @return array
     * @see https://documenter.getpostman.com/view/6250828/S17m1BbV?version=latest#1403949b-2a3c-4bc3-982c-7923f31f22f5
     */
    public function getVisitId()
    {
        return $this->_get('visit');
    }

    /**
     * Adds recording to visit with given id.
     *
     * @param array $parameters
     * @return array
     * @see https://documenter.getpostman.com/view/6250828/S17m1BbV?version=latest#eb72c015-046b-4fb6-8284-14bdb45bc9ea
     */
    public function addPointRecord(string $visitId, array $parameters = [])
    {
        return $this->_post("visit/$visitId", [
                    RequestOptions::JSON => $parameters
        ]);
    }

}
