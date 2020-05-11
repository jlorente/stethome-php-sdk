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

namespace Jlorente\StethoMe\Core;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Jlorente\StethoMe\ConfigInterface;
use Jlorente\StethoMe\Exception\Handler;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class Api implements ApiInterface
{

    /**
     * The client access token obtained from the StethoMe API.
     * 
     * @var string
     */
    protected $cachedAccessToken;

    /**
     * The Config repository instance.
     *
     * @var \Jlorente\StethoMe\ConfigInterface
     */
    protected $config;

    /**
     * Constructor.
     *
     * @param \Jlorente\StethoMe\ConfigInterface $config
     * @return void
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function _get($url = null, $parameters = [])
    {
        return $this->execute('get', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _head($url = null, array $parameters = [])
    {
        return $this->execute('head', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _delete($url = null, array $parameters = [])
    {
        return $this->execute('delete', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _put($url = null, array $parameters = [])
    {
        return $this->execute('put', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _patch($url = null, array $parameters = [])
    {
        return $this->execute('patch', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _post($url = null, array $parameters = [])
    {
        return $this->execute('post', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _options($url = null, array $parameters = [])
    {
        return $this->execute('options', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function execute($httpMethod, $url, array $parameters = [])
    {
        try {
            $response = $this->getClient($this->config)->{$httpMethod}('/' . $url, $parameters);

            return json_decode((string) $response->getBody(), true);
        } catch (ClientException $e) {
            new Handler($e);
        }
    }

    /**
     * Returns an Http client instance.
     *
     * @return \GuzzleHttp\Client
     */
    protected function getClient(ConfigInterface $config)
    {
        return new Client([
            'base_uri' => $config->getBaseUri(), 'handler' => $this->createHandler($config)
        ]);
    }

    /**
     * Create the client handler.
     *
     * @return \GuzzleHttp\HandlerStack
     */
    protected function createHandler(ConfigInterface $config)
    {
        $stack = HandlerStack::create();
        $stack->push($this->getAccessTokenMiddleware($config));
        $stack->push(Middleware::retry(function ($retries, RequestInterface $request, ResponseInterface $response = null, TransferException $exception = null) use ($config) {
                    return $retries < $config->getRequestRetries() && ($exception instanceof ConnectException || ($response && $response->getStatusCode() >= 500));
                }, function ($retries) {
                    return (int) pow(2, $retries) * 1000;
                }));
        return $stack;
    }

    /**
     * 
     * @param ConfigInterface $config
     * @return callable
     */
    protected function getAccessTokenMiddleware(ConfigInterface $config)
    {
        return function (callable $next) use ($config) {
            return function (RequestInterface $request, array $options) use ($next, $config) {
                return $next($this->applyAccessToken($request, $config), $options);
            };
        };
    }

    /**
     * 
     * @param RequestInterface $request
     * @return RequestInterface
     */
    protected function applyAccessToken(RequestInterface $request, ConfigInterface $config)
    {
        return $request->withHeader('Authorization', 'Bearer ' . $this->getAccessToken($config));
    }

    /**
     * Gets the access token needed to call the api.
     * 
     * @return string
     */
    public function getAccessToken(ConfigInterface $config)
    {
        $token = $this->getCachedAccessToken();
        if ($this->isAccessTokenValid($token) === false) {
            $token = $this->acquireAccessToken($config);
        }
        return $token;
    }

    /**
     * Checks whether the client token is valid or not.
     * 
     * @param string $token
     * @return bool
     */
    public function isAccessTokenValid($token = null)
    {
        return !!$token;
    }

    /**
     * 
     * @param ConfigInterface $config
     * @return string
     */
    protected function acquireAccessToken(ConfigInterface $config)
    {
        $client = new Client([
            'base_uri' => $this->config->getBaseUri()
            , 'headers' => array_merge($config->getHeaders(), [
                'Authorization' => 'Bearer ' . $config->getVendorToken()
            ])
        ]);
        $responseBody = $client->get('token')->getBody();
        $response = json_decode((string) $responseBody, true);
        $this->setCachedAccessToken($response['token']);
        return $response['token'];
    }

    /**
     * Gets the stored access token.
     * 
     * @return string
     */
    public function getCachedAccessToken()
    {
        return $this->cachedAccessToken;
    }

    /**
     * Sets the stored access token.
     * 
     * @param string $token
     */
    public function setCachedAccessToken($token)
    {
        $this->cachedAccessToken = $token;
    }

}
