<?php

namespace Omnipay\PayKasa;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\PayKasa\Message\PayoutRequest;
use Omnipay\PayKasa\Message\PurchaseRequest;
use Omnipay\PayKasa\Message\FetchTransactionRequest;
use Omnipay\PayKasa\Message\FetchVoucherProductsRequest;

/**
 * Class Gateway
 * @package Omnipay\PayKasa
 */
class Gateway extends AbstractGateway
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'PayKasa';
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            'token'    => '',
            'testMode' => false
        );
    }

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
     * @param array $parameters
     *
     * @return AbstractRequest|PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayKasa\Message\PurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|PayoutRequest
     */
    public function payout(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayKasa\Message\PayoutRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|FetchTransactionRequest
     */
    public function fetchTransaction(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayKasa\Message\FetchTransactionRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|FetchVoucherProductsRequest
     */
    public function fetchVoucherProducts(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayKasa\Message\FetchVoucherProductsRequest', $parameters);
    }
}
