<?php

namespace Omnipay\PayKasa\Message;

/**
 * Class AbstractRequest
 * @package Omnipay\PayKasa\Message
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * @var string
     */
    protected $liveEndpoint = 'https://api.paykasa.com/api';

    /**
     * @var string
     */
    protected $testEndpoint = 'https://test.api.paykasa.com/api';

    /**
     * @var int
     */
    protected $version = 3;

    /**
     * Get PayKasa API token.
     *
     * @return string token
     */
    public function getToken()
    {
        return $this->getParameter('token');
    }

    /**
     * Set PayKasa API token.
     *
     * @param string $value token
     *
     * @return $this
     */
    public function setToken($value)
    {
        return $this->setParameter('token', $value);
    }

    /**
     * @param string $path
     *
     * @return string
     */
    protected function createUri($path)
    {
        return sprintf('%s/v%d/%s.json', $this->getEndpoint(), $this->version, $path);
    }

    /**
     * @return array
     */
    protected function createHeaders()
    {
        return array(
            'Content-Type' => 'application/json',
            'x-api-token'  => $this->getToken()
        );
    }

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
