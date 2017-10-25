<?php

namespace Omnipay\PayKasa\Message;

use Guzzle\Http\Exception\BadResponseException;

/**
 * Class PurchaseRequest
 * @package Omnipay\PayKasa\Message
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * @return string
     */
    public function getVoucherCode()
    {
        return $this->getParameter('voucherCode');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setVoucherCode($value)
    {
        return $this->setParameter('voucherCode', $value);
    }

    /**
     * @return string
     */
    public function getCustomerId()
    {
        return $this->getParameter('customerId');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setCustomerId($value)
    {
        return $this->setParameter('customerId', $value);
    }

    /**
     * @return string
     */
    public function getCustomerIpAddress()
    {
        return $this->getParameter('customerIpAddress');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setCustomerIpAddress($value)
    {
        return $this->setParameter('customerIpAddress', $value);
    }

    /**
     * @return string
     */
    public function getCustomerCountry()
    {
        return $this->getParameter('customerCountry');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setCustomerCountry($value)
    {
        return $this->setParameter('customerCountry', $value);
    }

    /**
     * @return string
     */
    public function getCustomerEmail()
    {
        return $this->getParameter('customerEmail');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setCustomerEmail($value)
    {
        return $this->setParameter('customerEmail', $value);
    }

    /**
     * @return array
     */
    public function getData()
    {
        $this->validate(
            'token',
            'voucherCode',
            'transactionId',
            'customerId',
            'currency',
            'amount'
        );

        $data = [
            'voucher_code'      => $this->getVoucherCode(),
            'customer_order_id' => $this->getTransactionId(),
            'customer_id'       => $this->getCustomerId(),
            'amount'            => $this->getAmount()
        ];

        if ($customerIpAddress = $this->getCustomerIpAddress()) {
            $data['customer_ip_addr'] = $customerIpAddress;
        }

        if ($customerCountry = $this->getCustomerCountry()) {
            $data['customer_country'] = $customerCountry;
        }

        if ($customerEmail = $this->getCustomerEmail()) {
            $data['customer_email'] = $customerEmail;
        }

        return $data;
    }

    /**
     * @param array $data
     *
     * @return PurchaseResponse
     */
    public function sendData($data)
    {
        $uri = $this->createUri('vouchers/redemptions');
        $headers = $this->createHeaders();

        try {
            $response = $this->httpClient->post($uri, $headers, $data)->send();
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
        }

        return new PurchaseResponse($this, $response->json());
    }
}
