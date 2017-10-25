<?php

namespace Omnipay\PayKasa\Message;

/**
 * Class AbstractResponse
 * @package Omnipay\PayKasa\Message
 */
abstract class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->getCode() === '00';
    }

    /**
     * @return null|string
     */
    public function getCode()
    {
        return isset($this->data['response_code']) ? (string) $this->data['response_code'] : null;
    }

    /**
     * @return null|string
     */
    public function getMessage()
    {
        return isset($this->data['response_message']) ? (string) $this->data['response_message'] : null;
    }
}
